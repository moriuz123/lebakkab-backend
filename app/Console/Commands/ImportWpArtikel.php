<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Berita;
use App\Models\Opd;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class ImportWpArtikel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:wp-artikel {opd_id?} {kategori_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import artikel from diskominfosp.lebakkab.go.id';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Memulai proses migrasi artikel...");

        // Default Diskominfo
        $opdId = $this->argument('opd_id');
        if (!$opdId) {
            $opd = Opd::where('nama', 'like', '%kominfo%')->first();
            $opdId = $opd ? $opd->id : null;
        }

        // Kategori "Artikel"
        $kategoriId = $this->argument('kategori_id');
        if (!$kategoriId) {
            $kategori = Kategori::firstOrCreate([
                'slug' => 'artikel'
            ], [
                'nama' => 'Artikel'
            ]);
            $kategoriId = $kategori->id;
        }

        $this->info("Menggunakan OPD ID: " . ($opdId ?? 'NULL') . ", Kategori ID: {$kategoriId}");

        $page = 1;
        $totalMigrated = 0;

        while (true) {
            $this->info("Mengambil data halaman {$page}...");
            
            try {
                $response = Http::withoutVerifying()
                    ->timeout(30)
                    ->get("https://diskominfosp.lebakkab.go.id/wp-json/wp/v2/posts", [
                        'per_page' => 50,
                        'page' => $page,
                        '_embed' => true, // Untuk ambil thumbnail
                    ]);

                if (!$response->successful()) {
                    if ($response->status() == 400) {
                        $this->info("Mencapai batas halaman. Selesai.");
                        break;
                    }
                    $this->error("Gagal mengambil data dari API: " . $response->status());
                    break;
                }

                $posts = $response->json();
                if (empty($posts)) {
                    break;
                }

                foreach ($posts as $post) {
                    $slug = urldecode($post['slug']);

                    if (Berita::where('slug', $slug)->exists()) {
                        $this->line("Melewati: {$slug} (sudah ada)");
                        continue;
                    }

                    // Ambil Thumbnail
                    $thumbnailPath = null;
                    if (isset($post['_embedded']['wp:featuredmedia'][0]['source_url'])) {
                        $imageUrl = $post['_embedded']['wp:featuredmedia'][0]['source_url'];
                        try {
                            $imageContent = Http::withoutVerifying()->timeout(20)->get($imageUrl)->body();
                            $extension = pathinfo($imageUrl, PATHINFO_EXTENSION);
                            if (!$extension) $extension = 'jpg';
                            
                            $filename = 'berita/thumbnails/' . Str::random(30) . '.' . $extension;
                            Storage::disk('s3')->put($filename, $imageContent, 'public');
                            $thumbnailPath = $filename;
                            $this->info("  [+] Thumbnail diunduh: {$filename}");
                        } catch (\Exception $e) {
                            $this->error("  [-] Gagal mengunduh gambar: {$imageUrl}");
                        }
                    }

                    // Insert ke Database
                    Berita::create([
                        'opd_id' => $opdId,
                        'kategori_id' => $kategoriId,
                        'judul' => html_entity_decode($post['title']['rendered']),
                        'slug' => $slug,
                        'konten' => $post['content']['rendered'],
                        'thumbnail' => $thumbnailPath,
                        'status' => 'published',
                        'tanggal_publish' => $post['date'],
                        'is_active' => true,
                        'tampil_di_portal' => true,
                        'user_id' => 1,
                        'created_at' => $post['date'],
                        'updated_at' => $post['modified'],
                    ]);

                    $this->info("Berhasil import: " . html_entity_decode($post['title']['rendered']));
                    $totalMigrated++;
                }

                $page++;

            } catch (\Exception $e) {
                $this->error("Error Exception: " . $e->getMessage());
                break;
            }
        }

        $this->info("Migrasi Selesai! Total Artikel yang dipindahkan: {$totalMigrated}");
    }
}
