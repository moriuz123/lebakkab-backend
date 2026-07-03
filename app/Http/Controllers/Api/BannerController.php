<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\FiltersByOpd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
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
        $opd = $request->query('opd_id', $request->query('opd', 'all'));
        $kategori = $request->query('kategori', 'all');
        $cacheKey = "banner.index.kategori_{$kategori}.opd_{$opd}";

        $banners = Cache::remember($cacheKey, 3600, function () use ($request) {
            $query = $this->applyOpdFilter(
                Banner::with('opd')->select('id', 'opd_id', 'tampil_di_portal', 'judul', 'gambar', 'slug', 'kategori', 'category', 'created_at'),
                $request
            );

            if ($request->has('kategori')) {
                $query->where('kategori', $request->query('kategori'));
            }

            return $query->get()->map(function ($banner) {
                // Karena path 'gambar' di DB sudah lengkap, generate URL otomatis (S3/Lokal)
                $banner->gambar_url = Storage::url($banner->gambar);
                return $banner;
            });
        });

        return response()->json($banners);
    }

    public function byKategori(Request $request, $kategori)
    {
        $opd = $request->query('opd_id', $request->query('opd', 'all'));
        $cacheKey = "banner.kategori_{$kategori}.opd_{$opd}";

        $banners = Cache::remember($cacheKey, 3600, function () use ($request, $kategori) {
            return $this->applyOpdFilter(Banner::with('opd'), $request)
                ->where('kategori', $kategori)
                ->select('id', 'opd_id', 'tampil_di_portal', 'judul', 'gambar', 'slug', 'kategori', 'created_at')
                ->get()
                ->map(function ($banner) {
                    $banner->gambar_url = Storage::url($banner->gambar);
                    return $banner;
                });
        });

        return response()->json($banners);
    }
}
