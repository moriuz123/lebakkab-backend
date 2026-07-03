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
        $query = $this->applyOpdFilter(InformasiLayanan::with('opd'), $request)
            ->orderBy('created_at', 'desc');

        // Jika ada limit, terapkan
        if ($limit) {
            $query->limit($limit);
        }

        $layanan = $query->get()->map(function ($item) {
            if ($item->cover) {
                $item->cover = asset('storage/' . $item->cover);
            }
            return $item;
        });

        return response()->json($layanan);
    }

    public function show(Request $request, $slug)
    {
        $layanan = $this->applyOpdFilter(InformasiLayanan::with('opd'), $request)
            ->where('slug', $slug)
            ->firstOrFail();

        if ($layanan->cover) {
            $layanan->cover = asset('storage/' . $layanan->cover);
        }

        return response()->json($layanan);
    }
}
