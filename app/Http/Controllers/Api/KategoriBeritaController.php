<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class KategoriBeritaController extends Controller
{
    public function index(Request $request)
    {
        $opd = $request->query('opd_id', $request->query('opd'));
        
        $cacheKey = "kategori.berita.opd_" . ($opd ?: 'pusat');
        
        $kategoris = Cache::remember($cacheKey, 3600, function () use ($opd) {
            $query = Kategori::query();
            
            if (blank($opd)) {
                // Web utama: hanya kategori global
                $query->whereNull('opd_id');
            } else {
                // OPD: Kategori milik OPD tersebut ATAU kategori global
                $opds = explode(',', $opd);
                $query->where(function($q) use ($opds) {
                    $q->whereNull('opd_id');
                    foreach ($opds as $singleOpd) {
                        $singleOpd = trim($singleOpd);
                        if (is_numeric($singleOpd)) {
                            $q->orWhere('opd_id', $singleOpd);
                        } else {
                            $q->orWhereHas('opd', fn ($opdQuery) => $opdQuery->where('slug', $singleOpd));
                        }
                    }
                });
            }
            
            return $query->orderBy('nama', 'asc')->get();
        });

        return response()->json($kategoris);
    }
}
