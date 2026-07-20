<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilOpd extends Model
{
    protected $table = 'profil_opds';
    
    protected $fillable = [
        'opd_id',
        'latar_belakang',
        'visi',
        'misi',
        'tugas_pokok',
        'fungsi',
        'bidang_kerja',
        'struktur_organisasi',
    ];

    protected $casts = [
        'bidang_kerja' => 'array',
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }
}
