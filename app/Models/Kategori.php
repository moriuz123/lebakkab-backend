<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['nama', 'slug', 'opd_id'];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }
}
