<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('galeris')->insert([
            [
                'judul' => 'Kegiatan Musyawarah Daerah',
                'gambar' => 'https://via.placeholder.com/600x400?text=Galeri+1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Peresmian Gedung Baru',
                'gambar' => 'https://via.placeholder.com/600x400?text=Galeri+2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Kegiatan Sosial',
                'gambar' => 'https://via.placeholder.com/600x400?text=Galeri+3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
