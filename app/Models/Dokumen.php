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
        'slug',
        'sumber',
        'file_path',
        'link_drive',
        'tanggal_unggah'
    ];

    protected $casts = [
        'tampil_di_portal' => 'boolean',
    ];

    public function kategoris()
    {
        return $this->belongsToMany(KategoriDokumen::class, 'dokumen_kategori');
    }



    public function getFileUrlAttribute()
    {
        return $this->file_path ? Storage::url($this->file_path) : null;
    }
}
