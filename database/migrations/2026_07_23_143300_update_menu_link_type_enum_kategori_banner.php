<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Alter the link_type enum to add 'kategori_banner'
        DB::statement("ALTER TABLE menus MODIFY link_type ENUM('home','halaman_statis','kategori_berita','kategori_dokumen','modul','pejabat','eksternal','parent','kategori_banner') NULL");
    }

    public function down(): void
    {
        // Revert the link_type enum (this might fail if there is existing data using kategori_banner, but it's okay for down())
        DB::statement("ALTER TABLE menus MODIFY link_type ENUM('home','halaman_statis','kategori_berita','kategori_dokumen','modul','pejabat','eksternal','parent') NULL");
    }
};
