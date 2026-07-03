<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\FiltersByOpd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Berita;

class BeritaController extends Controller
{
    use FiltersByOpd;

    // 🔹 Semua berita (default 6 terbaru)
    public function index(Request $request)
    {
        $beritas = $this->applyOpdFilter(Berita::with(['kategori', 'opd']), $request)
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

        return response()->json($beritas);
    }

    // 🔹 Detail berita by slug
    public function show(Request $request, $slug)
    {
        $berita = $this->applyOpdFilter(Berita::with(['kategori', 'opd']), $request)
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

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
        $beritas = $this->applyOpdFilter(Berita::with(['kategori', 'opd']), $request)
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

        return response()->json($beritas);
    }

    // 🔹 Berita terbaru (default 5)
    public function latest(Request $request)
    {
        $beritas = $this->applyOpdFilter(Berita::with(['kategori', 'opd']), $request)
            ->latestNews()
            ->get();

        return response()->json($beritas);
    }

    // 🔹 Berita populer (default 5)
    public function popular(Request $request)
    {
        $beritas = $this->applyOpdFilter(Berita::with(['kategori', 'opd']), $request)
            ->popularNews()
            ->get();

        return response()->json($beritas);
    }
}
