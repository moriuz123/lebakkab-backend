<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\FiltersByOpd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Dokumen;
use App\Models\Opd;
use App\Models\InformasiLayanan;
use App\Models\Pengumuman;
use App\Models\Agenda;
use App\Models\DataAplikasi; // ✅ Penambahan modul DataAplikasi
use App\Models\Kecamatan; // ✅ Penambahan model Kecamatan


class SearchController extends Controller
{
    use FiltersByOpd;

    public function search(Request $request)
    {
        $q = $request->query('q');

        if (!$q) {
            return response()->json([
                'berita' => [],
                'dokumen' => [],
                'opd' => [],
                'layanan' => [],
                'pengumuman' => [],
                'agenda' => [],
                'aplikasi' => [], // ✅ Tambahan hasil kosong untuk DataAplikasi
                'kecamatan' => [], // ✅ Penambahan hasil kosong untuk Kecamatan
            ]);
        }

        $results = [
            'berita' => $this->applyOpdFilter(Berita::with('opd'), $request)
                ->where(function ($query) use ($q) {
                    $query->where('judul', 'like', "%$q%")
                        ->orWhere('konten', 'like', "%$q%");
                })
                ->get(),

            'dokumen' => $this->applyOpdFilter(Dokumen::with('opd'), $request)
                ->where('judul', 'like', "%$q%")
                ->get(),

            'opd' => Opd::where('nama', 'like', "%$q%")->get(),

            'layanan' => $this->applyOpdFilter(InformasiLayanan::with('opd'), $request)
                ->where('judul', 'like', "%$q%")
                ->get(),

            'pengumuman' => $this->applyOpdFilter(Pengumuman::with('opd'), $request)
                ->where(function ($query) use ($q) {
                    $query->where('judul', 'like', "%$q%")
                        ->orWhere('isi', 'like', "%$q%");
                })
                ->get(),

            'agenda' => $this->applyOpdFilter(Agenda::with('opd'), $request)
                ->where(function ($query) use ($q) {
                    $query->where('judul', 'like', "%$q%")
                        ->orWhere('deskripsi', 'like', "%$q%");
                })
                ->get(),

            // ✅ Penambahan query DataAplikasi
            'aplikasi' => $this->applyOpdFilter(DataAplikasi::with('opd'), $request)
                ->where(function ($query) use ($q) {
                    $query->where('nama', 'like', "%$q%")
                        ->orWhere('deskripsi', 'like', "%$q%");
                })
                ->get(),

            // ✅ Penambahan query Kecamatan
            'kecamatan' => Kecamatan::where('nama', 'like', "%$q%")
                ->orWhere('deskripsi', 'like', "%$q%")
                ->get(),
        ];


        return response()->json($results);
    }
}
