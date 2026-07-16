<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class KategoriDokumen extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'slug', 'opd_id', 'parent_id'];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }

    public function dokumens()
    {
        return $this->belongsToMany(Dokumen::class, 'dokumen_kategori');
    }

    public function parent()
    {
        return $this->belongsTo(KategoriDokumen::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(KategoriDokumen::class, 'parent_id');
    }

    protected static function booted(): void
    {
        static::saving(function ($model) {
            // Update slug jika nama berubah atau slug kosong
            if ($model->isDirty('nama') || empty($model->slug)) {
                $model->slug = Str::slug($model->nama);
            }
        });
    }
}
