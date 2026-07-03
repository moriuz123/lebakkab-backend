<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    // List semua kecamatan
    public function index()
    {
        $data = Kecamatan::orderBy('urutan')->get();
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    // Detail kecamatan berdasarkan slug
    public function show($slug)
    {
        $data = Kecamatan::where('slug', $slug)->first();
        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kecamatan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
