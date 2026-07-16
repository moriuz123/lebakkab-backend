<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PpidObjectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kode_registrasi' => 'required|string|exists:ppid_requests,kode_registrasi',
            'alasan_keberatan' => 'required|string',
            'kasus_posisi' => 'required|string',
        ];
    }
}
