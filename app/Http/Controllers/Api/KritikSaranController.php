<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KritikSaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Concerns\FiltersByOpd;

class KritikSaranController extends Controller
{
    use FiltersByOpd;

    // Ambil semua kritik & saran (jika nanti mau ditampilkan)
    public function index(Request $request)
    {
        $kritik = $this->applyOpdFilter(KritikSaran::query(), $request)
            ->orderBy('id', 'desc')
            ->get();
        return response()->json($kritik);
    }

    // Simpan data baru dari form frontend
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'nullable|email|max:100',
            'judul' => 'required|string|max:150',
            'isi_kritik' => 'required|string',
            'no_hpusr' => 'nullable|string|max:20',
            'opd_id' => 'nullable|exists:opds,id',
        ]);

        if (empty($validated['opd_id']) && $request->has('opd')) {
            $opd = \App\Models\Opd::where('slug', $request->opd)->first();
            if ($opd) {
                $validated['opd_id'] = $opd->id;
            }
        }

        $validated['tanggal'] = now();
        $validated['status'] = 0; // default belum dibalas
        $validated['balas'] = null;

        KritikSaran::create($validated);

        return response()->json([
            'message' => 'Kritik dan saran berhasil dikirim.',
            'success' => true
        ]);
    }
}
