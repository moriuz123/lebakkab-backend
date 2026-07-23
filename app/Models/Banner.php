<?php
// app/Models/Banner.php

namespace App\Models;

use App\Models\Concerns\BelongsToOpd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

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
        'gambar' => 'array',
    ];

    protected static function booted()
    {
        static::saved(function ($banner) {
            Cache::flush();
        });

        static::deleted(function ($banner) {
            Cache::flush();
        });
    }
}
