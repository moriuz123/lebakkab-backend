<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengumumanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pengumumans')->insert([
            [
                'judul' => 'Pemadaman Listrik',
                'isi' => 'Akan ada pemadaman listrik pada 12 Juli 2025 di wilayah timur.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Pendaftaran Sekolah',
                'isi' => 'Pendaftaran sekolah dasar dibuka mulai 15 Juli hingga 30 Juli 2025.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
