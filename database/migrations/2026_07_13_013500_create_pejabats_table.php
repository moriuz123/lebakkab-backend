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
        Schema::create('pejabats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opd_id')->nullable()->constrained('opds')->nullOnDelete();
            $table->string('kategori_pejabat')->default('pejabat_opd'); // bupati, wakil_bupati, sekda, kepala_opd, pejabat_opd
            $table->string('nama');
            $table->string('jabatan');
            $table->string('nip')->nullable();
            $table->string('pangkat_golongan')->nullable();
            $table->string('foto');
            $table->text('pesan_singkat')->nullable();
            $table->string('periode')->nullable();
            $table->text('riwayat_pendidikan')->nullable();
            $table->text('riwayat_jabatan')->nullable();
            $table->json('social_media')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pejabats');
    }
};
