<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProfilDaerah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api\Concerns\FiltersByOpd;

class ProfilDaerahController extends Controller
{
    use FiltersByOpd;

    public function index(Request $request)
    {
        $query = ProfilDaerah::query();
        $query = $this->applyOpdFilter($query, $request);
        
        $profil = $query->first();

        if ($profil) {
            $profil->gambar_lambang_url = $profil->gambar_lambang 
                ? Storage::disk('s3')->url($profil->gambar_lambang) 
                : null;
        }

        return response()->json([
            'status' => 'success',
            'data' => $profil
        ]);
    }
}
