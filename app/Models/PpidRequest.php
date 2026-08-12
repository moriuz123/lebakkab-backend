<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\BelongsToOpd;

class PpidRequest extends Model
{
    use HasFactory, BelongsToOpd;

    protected $guarded = [];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }
}
