<?php

namespace App\Models;

use App\Models\Concerns\BelongsToOpd;
use Illuminate\Database\Eloquent\Model;

class DataAplikasi extends Model
{
    use BelongsToOpd;

    protected $fillable = [
        'nama',
        'opd_id',
        'tampil_di_portal',
        'slug',
        'jenis',
        'kategori', // ✅ DITAMBAHKAN INI
        'deskripsi',
        'link',
        'icon',
        'opd_pelaksana',
    ];

    protected $casts = [
        'tampil_di_portal' => 'boolean',
    ];
}
