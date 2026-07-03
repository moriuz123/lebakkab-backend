<?php
// app/Models/Banner.php

namespace App\Models;

use App\Models\Concerns\BelongsToOpd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory, BelongsToOpd;

    protected $fillable = [
        'judul',
        'opd_id',
        'tampil_di_portal',
        'slug',
        'gambar',
        'kategori',
    ];

    protected $casts = [
        'tampil_di_portal' => 'boolean',
    ];
}
