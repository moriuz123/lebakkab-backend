<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilDaerah extends Model
{
    protected $fillable = [
        'opd_id', 'sejarah_singkat', 'visi_misi', 'arti_lambang', 'gambar_lambang',
        'kondisi_geografis', 'demografi', 'potensi_daerah', 'peta_wilayah',
        'email', 'telepon', 'whatsapp', 'alamat', 'website', 'social_media'
    ];

    protected $casts = [
        'social_media' => 'array',
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }
}
