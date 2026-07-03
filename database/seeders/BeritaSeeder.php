<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        Berita::truncate(); // optional: hapus data lama

        Berita::create([
            'judul' => 'Program Pembangunan Infrastruktur',
            'konten' => 'Pemerintah daerah memulai proyek pembangunan jembatan baru...',
        ]);

        Berita::create([
            'judul' => 'Pelatihan Digital UMKM',
            'konten' => 'Diselenggarakan pelatihan digital marketing untuk pelaku UMKM lokal...',
        ]);
    }
}
