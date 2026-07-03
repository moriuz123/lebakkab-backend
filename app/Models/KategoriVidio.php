<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriVidio extends Model
{
    use HasFactory;

    protected $table = 'kategori_vidios'; // Nama tabel sesuai yang digunakan di database
    protected $primaryKey = 'id_kategori_vidio'; // Pastikan sesuai
    public $timestamps = false; // Jika tidak ada created_at dan updated_at

    protected $fillable = [
        'nama_kategori_vidio',
        'slug_kategori_vidio',
        'opd_id',
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }
}
