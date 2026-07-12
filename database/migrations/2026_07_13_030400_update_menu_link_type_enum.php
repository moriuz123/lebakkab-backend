<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE menus MODIFY link_type ENUM('home','halaman_statis','kategori_berita','kategori_dokumen','modul','pejabat','eksternal','parent') NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE menus MODIFY link_type ENUM('home','halaman_statis','kategori_berita','kategori_dokumen','modul','eksternal','parent') NULL");
    }
};
