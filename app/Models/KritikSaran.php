<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KritikSaran extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'judul',
        'isi_kritik',
        'tanggal',
        'status',
        'no_hpusr',
        'balas',
        'opd_id',
        'tampil_di_portal',
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }
}
