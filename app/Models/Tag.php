<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'slug', 'opd_id'];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tag) {
            if (empty($tag->slug)) {
                $tag->slug = Str::slug($tag->nama);
            }
        });

        static::updating(function ($tag) {
            if (empty($tag->slug)) {
                $tag->slug = Str::slug($tag->nama);
            }
        });
    }

    public function beritas()
    {
        return $this->belongsToMany(Berita::class);
    }
}
