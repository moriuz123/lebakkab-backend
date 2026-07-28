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
        Schema::create('layanan_ppids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opd_id')->nullable()->constrained('opds')->cascadeOnDelete();
            $table->string('icon')->nullable();
            $table->string('nama_layanan');
            $table->text('deskripsi_layanan')->nullable();
            $table->string('sumber_link_type')->nullable(); // 'halaman_statis', 'kategori_dokumen', 'sub_kategori_dokumen', 'link_eksternal'
            $table->string('link_ref')->nullable(); // ID of the referenced model, or the actual URL for link_eksternal
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_ppids');
    }
};
