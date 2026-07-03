<?php

namespace App\Models;

use App\Models\Concerns\BelongsToOpd;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory, BelongsToOpd;

    protected $fillable = [
        'judul',
        'opd_id',
        'tampil_di_portal',
        'kategori_foto_id',
        'gambar',
        'deskripsi',
    ];

    protected $casts = [
        'tampil_di_portal' => 'boolean',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriFoto::class, 'kategori_foto_id');
    }
}
