<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Http\Resources\MenuApiResource;
use App\Http\Controllers\Api\Concerns\FiltersByOpd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MenuController extends Controller
{
    use FiltersByOpd;

    public function index($type, Request $request)
    {
        $opdId = $request->get('opd_id') ?? $request->get('opd') ?? 'pusat';
        $lastUpdated = Cache::get('menu_last_updated', 1);
        $cacheKey = "api_menus_{$type}_opd_{$opdId}_v{$lastUpdated}";

        $menus = Cache::rememberForever($cacheKey, function () use ($type, $request) {
            $query = Menu::query();

            if ($request->has('opd_id') || $request->has('opd')) {
                $query = $this->applyOpdFilter($query, $request);
            } else {
                // Jika memanggil API tanpa parameter OPD (Web Utama)
                $query->whereNull('opd_id');
            }

            return $query->where('menu_type', $type)
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
        });

        return response()->json([
            'status' => 'success',
            'data' => $menus,
        ]);
    }
}
