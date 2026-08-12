<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\FiltersByOpd;
use App\Http\Controllers\Controller;
use App\Models\InformasiLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformasiLayananController extends Controller
{
    use FiltersByOpd;

    public function index(Request $request)
    {
        // Ambil parameter ?limit=5 jika ada
        $limit = $request->get('limit');

        // Query dasar
        $query = $this->applyOpdFilter(InformasiLayanan::with(['opd', 'kategoriLayanan']), $request)
            ->orderBy('created_at', 'desc');

        // Jika ada limit, terapkan limit, jika tidak gunakan pagination
        if ($limit) {
            $layanan = $query->limit($limit)->get();
        } else {
            $layanan = $query->paginate(12);
        }

        return response()->json($layanan);
    }

    public function byKategori(Request $request, $slug)
    {
        $query = $this->applyOpdFilter(InformasiLayanan::with(['opd', 'kategoriLayanan']), $request)
            ->whereHas('kategoriLayanan', function ($q) use ($slug) {
                $q->where('slug', $slug);
            })
            ->orderBy('created_at', 'desc');

        $layanan = $query->paginate(12);

        return response()->json($layanan);
    }

    public function show(Request $request, $slug)
    {
        $layanan = $this->applyOpdFilter(InformasiLayanan::with(['opd', 'kategoriLayanan']), $request)
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json($layanan);
    }
}
