<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\FiltersByOpd;
use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    use FiltersByOpd;

    /**
     * Ambil semua pengumuman atau batasi jumlah dengan query ?limit=
     */
    public function index(Request $request)
    {
        $limit = $request->query('limit');

        $query = $this->applyOpdFilter(Pengumuman::with('opd'), $request)
            ->orderBy('created_at', 'desc');

        if ($limit) {
            $pengumuman = $query->take((int) $limit)->get();
        } else {
            $pengumuman = $query->get();
        }

        return response()->json([
            'success' => true,
            'data' => $pengumuman,
        ]);
    }

    /**
     * Ambil detail pengumuman berdasarkan slug
     */
    public function show(Request $request, $slug)
    {
        $pengumuman = $this->applyOpdFilter(Pengumuman::with('opd'), $request)
            ->where('slug', $slug)
            ->first();

        if (!$pengumuman) {
            return response()->json([
                'success' => false,
                'message' => 'Pengumuman tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $pengumuman,
        ]);
    }
}
