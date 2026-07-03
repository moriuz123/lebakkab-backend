<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Concerns\BelongsToOpd;

class Berita extends Model
{
    use HasFactory, SoftDeletes, BelongsToOpd;

    protected $table = 'beritas';

    protected $fillable = [
        'judul',
        'opd_id',
        'tampil_di_portal',
        'penulis',
        'user_id',
        'slug',
        'kategori_id',
        'thumbnail',
        'konten',
        'tanggal_publish',
        'is_active',
        'status',
    ];

    protected $casts = [
        'tanggal_publish' => 'date',
        'is_active' => 'boolean',
        'tampil_di_portal' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($berita) {
            if (empty($berita->slug)) {
                $berita->slug = Str::slug($berita->judul);
            }
        });

        static::updating(function ($berita) {
            if (empty($berita->slug)) {
                $berita->slug = Str::slug($berita->judul);
            }
        });
    }

    // 🔹 Relasi
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // 🔹 Scope untuk konsistensi query
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeByKategoriSlug($query, $slug)
    {
        return $query->whereHas('kategori', function ($q) use ($slug) {
            $q->where('slug', $slug);
        });
    }

    public function scopeLatestNews($query, $limit = 5)
    {
        return $query->published()
            ->orderBy('tanggal_publish', 'desc')
            ->limit($limit);
    }

    public function scopePopularNews($query, $limit = 5)
    {
        return $query->published()
            ->orderBy('views', 'desc')
            ->limit($limit);
    }
}
