<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TteFeedback extends Model
{
    use HasFactory;

    protected $table = 'tte_feedbacks';
    protected $guarded = [];
}
