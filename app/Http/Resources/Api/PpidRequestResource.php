<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PpidRequestResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'kode_registrasi' => $this->kode_registrasi,
            'opd' => $this->opd ? [
                'id' => $this->opd->id,
                'nama' => $this->opd->nama,
            ] : null,
            'kategori_pemohon' => $this->kategori_pemohon,
            'nama_lengkap' => $this->nama_lengkap,
            'alamat' => $this->alamat,
            'rincian_informasi' => $this->rincian_informasi,
            'tujuan_penggunaan' => $this->tujuan_penggunaan,
            'cara_memperoleh' => $this->cara_memperoleh,
            'status' => $this->status,
            'catatan_admin' => $this->catatan_admin,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            // Sembunyikan KTP dan NIK/Email/No_HP dari API publik unless authenticated/admin
        ];
    }
}
