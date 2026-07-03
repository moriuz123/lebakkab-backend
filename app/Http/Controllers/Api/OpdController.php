<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Opd;

class OpdController extends Controller
{
    /**
     * Ambil semua OPD
     */
    public function index()
    {
        $opds = Opd::orderBy('urutan', 'asc')->get();
        return response()->json($opds);
    }

    /**
     * Detail OPD berdasarkan slug
     */
    public function show($slug)
    {
        $opd = Opd::where('slug', $slug)->firstOrFail();
        return response()->json($opd);
    }
}
