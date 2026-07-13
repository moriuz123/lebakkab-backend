<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KategoriLayanan;
use Illuminate\Http\Request;

class KategoriLayananController extends Controller
{
    public function index(Request $request)
    {
        // get all kategori layanan with count of informasi layanans
        $query = KategoriLayanan::withCount('informasiLayanans')->orderBy('nama', 'asc');
        
        $limit = $request->get('limit');
        if ($limit) {
            $data = $query->limit($limit)->get();
        } else {
            $data = $query->paginate(12);
        }

        return response()->json($data);
    }
}
