<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    protected $fillable = [
        'nama',
        'slug',
        'singkatan',
        'pimpinan',
        'deskripsi',
        'email',
        'telepon',
        'website',
        'alamat',
        'logo',
        'foto_kantor',
        'peta_embed',
        'urutan',
        'is_published',
    ];

    public function beritas()
    {
        return $this->hasMany(Berita::class);
    }

    public function agendas()
    {
        return $this->hasMany(Agenda::class);
    }

    public function pengumuman()
    {
        return $this->hasMany(Pengumuman::class);
    }

    public function dokumens()
    {
        return $this->hasMany(Dokumen::class);
    }

    public function layanan()
    {
        return $this->hasMany(InformasiLayanan::class);
    }
}
