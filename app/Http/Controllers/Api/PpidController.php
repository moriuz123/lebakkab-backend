<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PpidRequest;
use App\Models\PpidObjection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PpidController extends Controller
{
    public function storeRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'opd_id' => 'nullable|exists:opds,id',
            'kategori_pemohon' => 'required|in:Perorangan,Lembaga/Organisasi',
            'no_identitas' => 'required|string|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_hp' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'rincian_informasi' => 'required|string',
            'tujuan_penggunaan' => 'required|string',
            'cara_memperoleh' => 'required|in:Melihat/Membaca,Mendapatkan Salinan Softcopy,Mendapatkan Salinan Hardcopy',
            'file_identitas' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();
        
        // Generate Registration Code
        $data['kode_registrasi'] = 'PPID-' . date('Ymd') . '-' . strtoupper(Str::random(4));
        $data['status'] = 'Menunggu';

        if ($request->hasFile('file_identitas')) {
            $path = $request->file('file_identitas')->store('ppid/identitas', 'public');
            $data['file_identitas'] = $path;
        }

        $ppidRequest = PpidRequest::create($data);

        return response()->json([
            'message' => 'Permohonan informasi berhasil dikirim.',
            'data' => $ppidRequest
        ], 201);
    }

    public function storeObjection(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_registrasi' => 'required|string|exists:ppid_requests,kode_registrasi',
            'alasan_keberatan' => 'required|string',
            'kasus_posisi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $ppidRequest = PpidRequest::where('kode_registrasi', $request->kode_registrasi)->first();

        $data = $validator->validated();
        $data['ppid_request_id'] = $ppidRequest->id;
        $data['status'] = 'Menunggu';
        unset($data['kode_registrasi']);

        $objection = PpidObjection::create($data);

        return response()->json([
            'message' => 'Pengajuan keberatan berhasil dikirim.',
            'data' => $objection
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

        $ppidRequest = PpidRequest::where('kode_registrasi', $request->kode_registrasi)->first();

        if (!$ppidRequest) {
            return response()->json(['message' => 'Nomor registrasi tidak ditemukan.'], 404);
        }

        return response()->json([
            'data' => $ppidRequest
        ]);
    }
}
