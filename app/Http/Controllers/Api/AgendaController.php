<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\FiltersByOpd;
use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    use FiltersByOpd;

    public function index(Request $request)
    {
        $agendas = $this->applyOpdFilter(Agenda::with('opd'), $request)
            ->orderBy('tanggal_mulai', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $agendas,
        ]);
    }

    // 🔹 Tambahan untuk detail agenda
    public function show(Request $request, $id)
    {
        $agenda = $this->applyOpdFilter(Agenda::with('opd'), $request)->find($id);

        if (!$agenda) {
            return response()->json([
                'status' => 'error',
                'message' => 'Agenda tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $agenda,
        ]);
    }
}
