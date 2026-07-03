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

        return response()->json(
            $query->where('aktif', 1)->orderBy('order')->get()
        );
    }
}
