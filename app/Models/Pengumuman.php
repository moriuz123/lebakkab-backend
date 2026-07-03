<?php
// app/Models/Pengumuman.php

namespace App\Models;

use App\Models\Concerns\BelongsToOpd;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use BelongsToOpd;

    protected $table = 'pengumumen';

    protected $fillable = [
        'judul',
        'opd_id',
        'tampil_di_portal',
        'slug',
        'isi',
        'gambar',

        'file_lampiran',
        'tgl_pelaksanaan',
        'mulai_tayang',
        'selesai_tayang',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'tampil_di_portal' => 'boolean',
    ];
}
