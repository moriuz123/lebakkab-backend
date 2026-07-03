<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Http\Controllers\Api\Concerns\FiltersByOpd;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    use FiltersByOpd;

    public function index($type, Request $request)
    {
        $query = Menu::query();

        if ($request->has('opd_id') || $request->has('opd')) {
            $query = $this->applyOpdFilter($query, $request);
        } else {
            // Jika memanggil API tanpa parameter OPD (Web Utama)
            // Pastikan HANYA mengambil menu yang opd_id nya kosong
            $query->whereNull('opd_id');
        }

        $menus = clone $query;
        $menus = $menus->where('menu_type', $type)
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->with(['children' => function ($q) {
                $q->where('is_active', true)->orderBy('sort_order')
                    ->with(['children' => function ($q2) {
                        $q2->where('is_active', true)->orderBy('sort_order');
                    }]);
            }])
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $menus,
        ]);
    }
}
