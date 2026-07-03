<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\FiltersByOpd;
use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use App\Models\KategoriDokumen;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    use FiltersByOpd;

    public function index(Request $request)
    {
        $dokumen = $this->applyOpdFilter(Dokumen::with(['kategori', 'opd']), $request)
            ->latest()
            ->get();

        return response()->json($dokumen);
    }

    public function show(Request $request, $slug)
    {
        $dokumen = $this->applyOpdFilter(Dokumen::with(['kategori', 'opd']), $request)
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json($dokumen);
    }

    /**
     * Ambil dokumen berdasarkan kategori slug
     */
    public function byKategori(Request $request, $slug)
    {
        $kategori = KategoriDokumen::where('slug', $slug)->firstOrFail();

        $dokumen = $this->applyOpdFilter(Dokumen::with(['kategori', 'opd']), $request)
            ->where('kategori_dokumen_id', $kategori->id)
            ->latest()
            ->get();

        return response()->json([
            'kategori' => $kategori,
            'dokumen' => $dokumen
        ]);
    }
}
