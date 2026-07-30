<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('halaman_statis', function (Blueprint $table) {
            $table->dropUnique('pages_slug_unique');
            $table->unique(['opd_id', 'slug'], 'halaman_statis_opd_id_slug_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('halaman_statis', function (Blueprint $table) {
            $table->dropUnique('halaman_statis_opd_id_slug_unique');
            $table->unique('slug', 'pages_slug_unique');
        });
    }
};
