<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TteInfo;
use App\Models\TteRegistration;
use App\Models\TteFeedback;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class TteController extends Controller
{
    public function getInfo()
    {
        $infos = TteInfo::orderBy('urutan', 'asc')->get();
        return response()->json([
            'success' => true,
            'data' => $infos->groupBy('kategori')
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'opd_id' => 'required|exists:opds,id',
            'nik' => 'required|string|max:20',
            'nama_lengkap' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:50',
            'surat_rekomendasi' => 'required|file|mimes:pdf|max:5120', // max 5MB
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $path = $request->file('surat_rekomendasi')->store('tte/rekomendasi', 's3');

            $registration = TteRegistration::create([
                'opd_id' => $request->opd_id,
                'nik' => $request->nik,
                'nama_lengkap' => $request->nama_lengkap,
                'nip' => $request->nip,
                'jabatan' => $request->jabatan,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'surat_rekomendasi' => $path,
                'status' => 'menunggu',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan TTE berhasil dikirim.',
                'data' => $registration
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function feedback(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'instansi' => 'required|string|max:255',
            'pesan' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $feedback = TteFeedback::create($request->only(['nama', 'email', 'instansi', 'pesan', 'rating']));

            return response()->json([
                'success' => true,
                'message' => 'Feedback berhasil dikirim.',
                'data' => $feedback
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
