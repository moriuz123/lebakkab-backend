<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananPpid extends Model
{
    use HasFactory;

    protected $fillable = [
        'opd_id',
        'icon',
        'nama_layanan',
        'deskripsi_layanan',
        'sumber_link_type',
        'link_ref',
        'sort_order',
    ];

    const TYPE_HALAMAN_STATIS = 'halaman_statis';
    const TYPE_KATEGORI_DOKUMEN = 'kategori_dokumen';
    const TYPE_SUB_KATEGORI_DOKUMEN = 'sub_kategori_dokumen';
    const TYPE_LINK_EKSTERNAL = 'link_eksternal';

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }
}
