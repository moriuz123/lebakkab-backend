<?php

namespace App\Models;

use App\Models\Concerns\BelongsToOpd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiLayanan extends Model
{
    use HasFactory, BelongsToOpd;

    protected $fillable = [
        'judul',
        'opd_id',
        'tampil_di_portal',
        'deskripsi',
        'slug',
        'cover',
        'kontak',
        'unit_pelaksana',
        'status',
    ];

    protected $casts = [
        'tampil_di_portal' => 'boolean',
    ];
}
