<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poling;
use App\Http\Controllers\Api\Concerns\FiltersByOpd;

class PollingController extends Controller
{
    use FiltersByOpd;

    // Ambil pertanyaan + jawaban
    public function index(Request $request)
    {
        $pertanyaan = $this->applyOpdFilter(Poling::query(), $request)
            ->where('type', 'Pertanyaan')
            ->where('status', '1')
            ->get();

        $data = $pertanyaan->map(function ($q) {
            return [
                'id' => $q->poling_id,
                'pertanyaan' => $q->pilihan,
                'jawaban' => Poling::where('type', 'Jawaban')
                    ->where('id', $q->poling_id)
                    ->where('status', '1')
                    ->get(['poling_id as id', 'pilihan', 'rating']),
            ];
        });

        return response()->json($data);
    }

    // Simpan vote
    public function vote(Request $request)
    {
        $jawaban = Poling::where('poling_id', $request->id)
            ->where('type', 'Jawaban')
            ->first();

        if ($jawaban) {
            $jawaban->increment('rating');
            return response()->json(['success' => true, 'message' => 'Vote berhasil!']);
        }

        return response()->json(['success' => false, 'message' => 'Jawaban tidak ditemukan'], 404);
    }
}
