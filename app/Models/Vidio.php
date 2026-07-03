<?php
namespace App\Models;

use App\Models\Concerns\BelongsToOpd;
use Illuminate\Database\Eloquent\Model;

class Vidio extends Model
{
    use BelongsToOpd;

    protected $fillable = [
        'opd_id',
        'tampil_di_portal',
        'kategori_vidio_id',
        'judul_vidio',
        'keterangan',
        'sumber_youtube',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'tampil_di_portal' => 'boolean',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriVidio::class, 'kategori_vidio_id');
    }
}
