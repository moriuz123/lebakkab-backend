<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\FiltersByOpd;
use App\Http\Controllers\Controller;
use App\Models\DataAplikasi;
use Illuminate\Http\Request;

class DataAplikasiController extends Controller
{
    use FiltersByOpd;

    public function index(Request $request)
    {
        $kategori = $request->query('kategori');
        $jenis = $request->query('jenis');
        $search = $request->query('search');

        $query = $this->applyOpdFilter(
            DataAplikasi::with('opd')->select('id', 'opd_id', 'tampil_di_portal', 'nama', 'icon', 'link', 'deskripsi', 'kategori', 'jenis'),
            $request
        );

        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        if ($jenis) {
            $query->where('jenis', $jenis);
        }

        if ($search) {
            $query->where('nama', 'like', '%' . $search . '%');
        }

        $data = $query->get();

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function show(Request $request, $id)
    {
        $aplikasi = $this->applyOpdFilter(DataAplikasi::with('opd'), $request)->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $aplikasi,
        ]);
    }
}
