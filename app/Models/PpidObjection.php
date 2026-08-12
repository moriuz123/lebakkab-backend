<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PpidObjection extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ppidRequest()
    {
        return $this->belongsTo(PpidRequest::class);
    }
}
