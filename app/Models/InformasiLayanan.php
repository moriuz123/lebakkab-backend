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
        'jenis',
        'kategori_layanan_id',
        'opd_id',
        'tampil_di_portal',
        'deskripsi',
        'slug',
        'cover',
        'kontak',
        'unit_pelaksana',
        'link_rujukan',
        'status',
    ];

    protected $casts = [
        'tampil_di_portal' => 'boolean',
    ];

    public function kategoriLayanan()
    {
        return $this->belongsTo(KategoriLayanan::class);
    }
}
