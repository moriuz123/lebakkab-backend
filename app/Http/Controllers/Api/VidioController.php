<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\FiltersByOpd;
use App\Http\Controllers\Controller;
use App\Models\Vidio;
use Illuminate\Http\Request;

class VidioController extends Controller
{
    use FiltersByOpd;

    // GET semua video
    public function index(Request $request)
    {
        $vidios = $this->applyOpdFilter(Vidio::with(['kategori', 'opd']), $request)
            ->where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($vidios);
    }

    // GET detail video
    public function show(Request $request, $id)
    {
        $vidio = $this->applyOpdFilter(Vidio::with(['kategori', 'opd']), $request)->findOrFail($id);
        return response()->json($vidio);
    }
}
