<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            BeritaSeeder::class,
            GaleriSeeder::class,
            PengumumanSeeder::class,

            MenuSeeder::class, // ✅ Tambahkan ini
        ]);
    }
}
