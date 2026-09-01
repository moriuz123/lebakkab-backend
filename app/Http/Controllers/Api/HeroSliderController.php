<?php
namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use App\Http\Controllers\Api\Concerns\FiltersByOpd;
use Illuminate\Http\Request;

class HeroSliderController extends Controller
{
    use FiltersByOpd;

    public function index(Request $request)
    {
        $query = HeroSlider::query();

        if ($request->has('opd_id') || $request->has('opd')) {
            $query = $this->applyOpdFilter($query, $request);
        } else {
            // Main portal
            $query->whereNull('opd_id');
        }

        $sliders = $query->where('aktif', 1)->orderBy('order')->get();
        
        $sliders->transform(function ($item) {
            $item->gambar = $item->gambar ? \Illuminate\Support\Facades\Storage::url($item->gambar) : null;
            return $item;
        });

        return response()->json($sliders);
    }
}
