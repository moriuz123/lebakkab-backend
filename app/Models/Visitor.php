<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'ip_address',
        'user_agent',
        'page',
        'referrer',
        'visited_at',
        'opd_id',
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }
}
