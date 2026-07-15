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
        // 1. Tabel Registrasi TTE
        Schema::create('tte_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opd_id')->nullable()->constrained('opds')->nullOnDelete();
            $table->string('nik', 20)->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('nip')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('email')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('surat_rekomendasi')->nullable();
            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'ditolak'])->default('menunggu');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });

        // 2. Tabel Feedback TTE
        Schema::create('tte_feedbacks', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('email')->nullable();
            $table->string('instansi')->nullable();
            $table->text('pesan')->nullable();
            $table->integer('rating')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        // 3. Tabel Info TTE (Konten dinamis)
        Schema::create('tte_infos', function (Blueprint $table) {
            $table->id();
            $table->enum('kategori', ['tentang', 'alur_prosedur', 'syarat', 'tutorial']);
            $table->string('judul')->nullable();
            $table->longText('konten')->nullable();
            $table->string('gambar')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tte_infos');
        Schema::dropIfExists('tte_feedbacks');
        Schema::dropIfExists('tte_registrations');
    }
};
