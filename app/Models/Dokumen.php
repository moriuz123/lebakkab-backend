<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use App\Models\Concerns\BelongsToOpd;


class Dokumen extends Model
{
    use HasFactory, BelongsToOpd;

    protected $fillable = [
        'judul',
        'opd_id',
        'tampil_di_portal',
        'kategori_dokumen_id',
        'slug',
        'sumber',
        'file_path',
        'link_drive',
        'tanggal_unggah'
    ];

    protected $casts = [
        'tampil_di_portal' => 'boolean',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriDokumen::class, 'kategori_dokumen_id');
    }



    public function getFileUrlAttribute()
    {
        return $this->file_path ? Storage::url($this->file_path) : null;
    }
}
