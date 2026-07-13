<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('informasi_layanans', function (Blueprint $table) {
            $table->string('link_rujukan')->nullable()->after('kategori_layanan_id');
        });
    }

    public function down(): void
    {
        Schema::table('informasi_layanans', function (Blueprint $table) {
            $table->dropColumn('link_rujukan');
        });
    }
};
