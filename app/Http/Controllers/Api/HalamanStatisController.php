<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\FiltersByOpd;
use App\Http\Controllers\Controller;
use App\Models\HalamanStatis;
use Illuminate\Http\Request;

class HalamanStatisController extends Controller
{
    use FiltersByOpd;

    // Ambil semua halaman statis
    public function index(Request $request)
    {
        $data = $this->applyOpdFilter(
            HalamanStatis::with('opd')->select('id', 'opd_id', 'tampil_di_portal', 'judul', 'slug', 'isi', 'cover', 'created_at', 'updated_at'),
            $request
        )
            ->orderBy('updated_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    // Ambil detail halaman statis berdasarkan slug
    public function show(Request $request, $slug)
    {
        $page = $this->applyOpdFilter(HalamanStatis::with('opd'), $request)
            ->where('slug', $slug)
            ->first();

        if (!$page) {
            return response()->json([
                'status' => 'error',
                'message' => 'Halaman tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $page
        ]);
    }
}
