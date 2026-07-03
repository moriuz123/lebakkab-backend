<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    protected $fillable = [
        'icon', // ✅ tambahkan
        'title',
        'menu_type',
        'parent_id',
        'link_type',
        'link_ref',
        'url',
        'is_active',
        'sort_order',
        'opd_id',
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    /**
     * Atur otomatis sort_order jika tidak diisi
     */
    protected static function booted()
    {
        static::creating(function ($menu) {
            if (empty($menu->sort_order) || $menu->sort_order == 0) {
                $menu->sort_order = static::max('sort_order') + 1;
            }
        });
    }
    // public function getUrlAttribute()
    // {
    //     switch ($this->link_type) {
    //         case 'home':
    //             return url('/'); // 🔹 Beranda
    //         case 'halaman_statis':
    //             return url('/page/' . $this->link_ref); // atau slug halaman
    //         case 'kategori_berita':
    //             return url('/kategori/' . $this->link_ref);
    //         case 'modul':
    //             return url('/' . $this->link_ref); // 🔹 tanpa /modul/
    //         case 'eksternal':
    //             return $this->attributes['url'] ?? null; // ambil mentah dari kolom DB

    //         case 'parent':
    //         default:
    //             return null; // 🔹 tidak ada link
    //     }
    // }
    public function getUrlAttribute()
    {
        switch ($this->link_type) {
            case 'home':
                return '/';
            case 'halaman_statis':
                return '/page/' . $this->link_ref;
            case 'kategori_berita':
                return '/berita/kategori/' . $this->link_ref;
            case 'kategori_dokumen': // 🔹 kategori dokumen by slug
                return '/dokumen/kategori/' . $this->link_ref;
            case 'modul':
                return '/' . ltrim($this->link_ref, '/');
            case 'eksternal':
                return $this->attributes['url'] ?? null;
            case 'parent':
            default:
                return null;
        }
    }
}
