<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\FiltersByOpd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use App\Models\Berita;

class BeritaController extends Controller
{
    use FiltersByOpd;

    // 🔹 Semua berita (default 6 terbaru)
    public function index(Request $request)
    {
        $opd = $request->query('opd_id', $request->query('opd', 'all'));
        $cacheKey = "berita.index.opd_{$opd}";

        $beritas = Cache::remember($cacheKey, 3600, function () use ($request) {
            return $this->applyOpdFilter(Berita::with(['kategori', 'opd']), $request)
                ->published()
                ->orderBy('tanggal_publish', 'desc')
                ->limit(10)
                ->get()
                ->map(function ($item) {
                    $item->image = $item->thumbnail
                        ? Storage::url($item->thumbnail)
                        : asset('images/default-thumbnail.jpg');
                    return $item;
                });
        });

        return response()->json($beritas);
    }

    // 🔹 Detail berita by slug
    public function show(Request $request, $slug)
    {
        $opd = $request->query('opd_id', $request->query('opd', 'all'));
        $cacheKey = "berita.show.{$slug}.opd_{$opd}";

        $berita = Cache::remember($cacheKey, 3600, function () use ($request, $slug) {
            return $this->applyOpdFilter(Berita::with(['kategori', 'opd']), $request)
                ->published()
                ->where('slug', $slug)
                ->firstOrFail();
        });

        // ✅ Tambah counter views otomatis
        $berita->increment('views');

        // ✅ Siapkan gambar thumbnail
        $berita->image = $berita->thumbnail
            ? Storage::url($berita->thumbnail)
            : asset('images/default-thumbnail.jpg');

        return response()->json($berita);
    }

    // 🔹 Filter berita berdasarkan kategori slug
    public function byKategori(Request $request, $slug)
    {
        $opd = $request->query('opd_id', $request->query('opd', 'all'));
        $cacheKey = "berita.kategori.{$slug}.opd_{$opd}";

        $beritas = Cache::remember($cacheKey, 3600, function () use ($request, $slug) {
            return $this->applyOpdFilter(Berita::with(['kategori', 'opd']), $request)
                ->byKategoriSlug($slug)
                ->published()
                ->orderBy('tanggal_publish', 'desc')
                ->get()
                ->map(function ($item) {
                    $item->image = $item->thumbnail
                        ? Storage::url($item->thumbnail)
                        : asset('images/default-thumbnail.jpg');
                    return $item;
                });
        });

        return response()->json($beritas);
    }

    // 🔹 Berita terbaru (default 5)
    public function latest(Request $request)
    {
        $opd = $request->query('opd_id', $request->query('opd', 'all'));
        $cacheKey = "berita.latest.opd_{$opd}";

        $beritas = Cache::remember($cacheKey, 3600, function () use ($request) {
            return $this->applyOpdFilter(Berita::with(['kategori', 'opd']), $request)
                ->latestNews()
                ->get();
        });

        return response()->json($beritas);
    }

    // 🔹 Berita populer (default 5)
    public function popular(Request $request)
    {
        $opd = $request->query('opd_id', $request->query('opd', 'all'));
        $cacheKey = "berita.popular.opd_{$opd}";

        $beritas = Cache::remember($cacheKey, 3600, function () use ($request) {
            return $this->applyOpdFilter(Berita::with(['kategori', 'opd']), $request)
                ->popularNews()
                ->get();
        });

        return response()->json($beritas);
    }
}
