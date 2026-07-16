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
        // 1. Create pivot table
        Schema::create('dokumen_kategori', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dokumen_id');
            $table->unsignedBigInteger('kategori_dokumen_id');
            $table->timestamps();

            $table->foreign('dokumen_id')->references('id')->on('dokumens')->onDelete('cascade');
            $table->foreign('kategori_dokumen_id')->references('id')->on('kategori_dokumens')->onDelete('cascade');
        });

        // 2. Migrate existing data
        DB::statement('INSERT INTO dokumen_kategori (dokumen_id, kategori_dokumen_id, created_at, updated_at) SELECT id, kategori_dokumen_id, NOW(), NOW() FROM dokumens WHERE kategori_dokumen_id IS NOT NULL');

        // 3. Drop column from dokumens
        Schema::table('dokumens', function (Blueprint $table) {
            $table->dropForeign('dokumens_kategori_dokumen_id_foreign');
            $table->dropColumn('kategori_dokumen_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokumens', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_dokumen_id')->nullable();
            $table->foreign('kategori_dokumen_id', 'dokumens_kategori_dokumen_id_foreign')->references('id')->on('kategori_dokumens')->onDelete('cascade');
        });

        DB::statement('UPDATE dokumens d JOIN (SELECT dokumen_id, MIN(kategori_dokumen_id) as kategori_dokumen_id FROM dokumen_kategori GROUP BY dokumen_id) dk ON d.id = dk.dokumen_id SET d.kategori_dokumen_id = dk.kategori_dokumen_id');

        Schema::dropIfExists('dokumen_kategori');
    }
};
