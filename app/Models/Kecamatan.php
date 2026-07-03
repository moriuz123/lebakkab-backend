<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatans';

    protected $fillable = [
        'nama',
        'slug',
        'kode_kecamatan',
        'nama_camat',
        'deskripsi',
        'alamat_kantor',
        'email',
        'telepon',
        'website',
        'logo',
        'foto_kantor',
        'peta_embed',
        'urutan',
        'created_at',
        'updated_at',
    ];
}
