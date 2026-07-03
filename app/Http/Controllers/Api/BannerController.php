<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\FiltersByOpd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    use FiltersByOpd;

    /**
     * Ambil semua banner atau filter berdasarkan kategori (query parameter)
     * Contoh:
     * - GET /api/banner           -> semua banner
     * - GET /api/banner?kategori=infografis  -> banner kategori infografis
     */
    public function index(Request $request)
    {
        $query = $this->applyOpdFilter(
            Banner::with('opd')->select('id', 'opd_id', 'tampil_di_portal', 'judul', 'gambar', 'slug', 'kategori', 'category', 'created_at'),
            $request
        );

        if ($request->has('kategori')) {
            $query->where('kategori', $request->query('kategori'));
        }

        $banners = $query->get()->map(function ($banner) {
            // Karena path 'gambar' di DB sudah lengkap, tinggal tambah prefix 'storage/'
            $banner->gambar_url = asset('storage/' . $banner->gambar);
            return $banner;
        });

        return response()->json($banners);
    }

    public function byKategori(Request $request, $kategori)
    {
        $banners = $this->applyOpdFilter(Banner::with('opd'), $request)
            ->where('kategori', $kategori)
            ->select('id', 'opd_id', 'tampil_di_portal', 'judul', 'gambar', 'slug', 'kategori', 'created_at')
            ->get()
            ->map(function ($banner) {
                $banner->gambar_url = asset('storage/' . $banner->gambar);
                return $banner;
            });

        return response()->json($banners);
    }
}
