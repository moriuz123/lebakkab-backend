<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PpidStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
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
        ];
    }
}
