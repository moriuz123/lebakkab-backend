<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pejabat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api\Concerns\FiltersByOpd;

class PejabatController extends Controller
{
    use FiltersByOpd;

    public function index(Request $request)
    {
        $query = Pejabat::where('is_active', true);

        // Filter by OPD if available
        $query = $this->applyOpdFilter($query, $request);

        // Filter by category if requested
        if ($request->has('kategori')) {
            $query->where('kategori_pejabat', $request->get('kategori'));
        }

        $pejabats = $query->orderBy('sort_order', 'asc')->get();

        $pejabats->transform(function ($pejabat) {
            $pejabat->foto_url = $pejabat->foto ? Storage::disk('s3')->url($pejabat->foto) : null;
            return $pejabat;
        });

        return response()->json([
            'status' => 'success',
            'data' => $pejabats
        ]);
    }

    public function show($id, Request $request)
    {
        $query = Pejabat::query();
        $query = $this->applyOpdFilter($query, $request);
        
        $pejabat = $query->find($id);

        if (!$pejabat) {
            return response()->json(['status' => 'error', 'message' => 'Pejabat not found'], 404);
        }

        $pejabat->foto_url = $pejabat->foto ? Storage::disk('s3')->url($pejabat->foto) : null;

        return response()->json([
            'status' => 'success',
            'data' => $pejabat
        ]);
    }
}
