<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class KategoriBeritaController extends Controller
{
    public function index()
    {
        $kategoris = Cache::remember('kategori.berita.all', 3600, function () {
            return Kategori::where('is_active', true)->orderBy('nama', 'asc')->get();
        });

        return response()->json($kategoris);
    }
}
