<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PpidRequest;
use App\Models\PpidObjection;
use App\Http\Requests\PpidStoreRequest;
use App\Http\Requests\PpidObjectionRequest;
use App\Http\Resources\Api\PpidRequestResource;
use App\Http\Resources\Api\PpidObjectionResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PpidController extends Controller
{
    public function storeRequest(PpidStoreRequest $request)
    {
        $data = $request->validated();
        
        // Generate Registration Code
        $data['kode_registrasi'] = 'PPID-' . date('Ymd') . '-' . strtoupper(Str::random(4));
        $data['status'] = 'Menunggu';

        if ($request->hasFile('file_identitas')) {
            $path = $request->file('file_identitas')->store('ppid/identitas', 's3');
            $data['file_identitas'] = $path;
        }

        $ppidRequest = PpidRequest::create($data);

        return response()->json([
            'message' => 'Permohonan informasi berhasil dikirim.',
            'data' => new PpidRequestResource($ppidRequest)
        ], 201);
    }

    public function storeObjection(PpidObjectionRequest $request)
    {
        $ppidRequest = PpidRequest::where('kode_registrasi', $request->kode_registrasi)->first();

        $data = $request->validated();
        $data['ppid_request_id'] = $ppidRequest->id;
        $data['status'] = 'Menunggu';
        unset($data['kode_registrasi']);

        $objection = PpidObjection::create($data);

        return response()->json([
            'message' => 'Pengajuan keberatan berhasil dikirim.',
            'data' => new PpidObjectionResource($objection)
        ], 201);
    }

    public function checkStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_registrasi' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $ppidRequest = PpidRequest::with('opd')->where('kode_registrasi', $request->kode_registrasi)->first();

        if (!$ppidRequest) {
            return response()->json(['message' => 'Nomor registrasi tidak ditemukan.'], 404);
        }

        return response()->json([
            'data' => new PpidRequestResource($ppidRequest)
        ]);
    }
}
