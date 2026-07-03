<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\FiltersByOpd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Foto;

class FotoController extends Controller
{
    use FiltersByOpd;

    // Ambil semua data foto
    public function index(Request $request)
    {
        $fotos = $this->applyOpdFilter(Foto::with(['kategori', 'opd']), $request)->latest()->get();
        return response()->json($fotos);
    }

    // Ambil detail foto berdasarkan id
    public function show(Request $request, $id)
    {
        $foto = $this->applyOpdFilter(Foto::with(['kategori', 'opd']), $request)->findOrFail($id);
        return response()->json($foto);
    }
}
