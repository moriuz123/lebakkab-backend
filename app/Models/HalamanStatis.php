<?php
// app/Models/Page.php

namespace App\Models;

use App\Models\Concerns\BelongsToOpd;
use Illuminate\Database\Eloquent\Model;

class HalamanStatis extends Model
{
    use BelongsToOpd;

    protected $fillable = ['judul', 'opd_id', 'tampil_di_portal', 'slug', 'isi', 'cover'];

    protected $casts = [
        'tampil_di_portal' => 'boolean',
    ];
}
