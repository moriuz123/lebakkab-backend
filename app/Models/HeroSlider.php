<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSlider extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'aktif',
        'status',
        'order',
        'opd_id',
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }
}
