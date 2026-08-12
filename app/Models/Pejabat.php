<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model
{
    protected $fillable = [
        'opd_id', 'kategori_pejabat', 'nama', 'jabatan', 'nip', 'pangkat_golongan',
        'foto', 'pesan_singkat', 'periode', 'riwayat_pendidikan', 'riwayat_jabatan',
        'social_media', 'sort_order', 'is_active'
    ];

    protected $casts = [
        'social_media' => 'array',
        'is_active' => 'boolean',
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }
    
    protected static function booted()
    {
        static::creating(function ($pejabat) {
            if (empty($pejabat->sort_order) || $pejabat->sort_order == 0) {
                $pejabat->sort_order = static::max('sort_order') + 1;
            }
        });
    }
}
