<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Menu extends Model
{
    public const TYPE_MAIN = 'main';
    public const TYPE_FRONT = 'front';
    public const TYPE_FOOTER_1 = 'footer_widget_1';
    public const TYPE_FOOTER_2 = 'footer_widget_2';

    public const LINK_HOME = 'home';
    public const LINK_HALAMAN_STATIS = 'halaman_statis';
    public const LINK_KATEGORI_BERITA = 'kategori_berita';
    public const LINK_KATEGORI_DOKUMEN = 'kategori_dokumen';
    public const LINK_MODUL = 'modul';
    public const LINK_EKSTERNAL = 'eksternal';
    public const LINK_PARENT = 'parent';
    public const LINK_PEJABAT = 'pejabat';

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

        // Hapus cache menu (Cache Busting dengan Versioning)
        static::saved(function () {
            Cache::put('menu_last_updated', now()->timestamp);
        });
        static::deleted(function () {
            Cache::put('menu_last_updated', now()->timestamp);
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
            case self::LINK_HOME:
                return '/';
            case self::LINK_HALAMAN_STATIS:
                return '/page/' . $this->link_ref;
            case self::LINK_KATEGORI_BERITA:
                return '/berita/kategori/' . $this->link_ref;
            case self::LINK_KATEGORI_DOKUMEN: // 🔹 kategori dokumen by slug
                return '/dokumen/kategori/' . $this->link_ref;
            case self::LINK_MODUL:
                return '/' . ltrim($this->link_ref, '/');
            case self::LINK_PEJABAT:
                return '/pejabat/' . $this->link_ref;
            case self::LINK_EKSTERNAL:
                return $this->attributes['url'] ?? null;
            case self::LINK_PARENT:
            default:
                return null;
        }
    }
}
