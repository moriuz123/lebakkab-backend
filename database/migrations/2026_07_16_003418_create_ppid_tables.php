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
        Schema::create('ppid_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('opd_id')->nullable();
            $table->string('kode_registrasi')->unique();
            $table->enum('kategori_pemohon', ['Perorangan', 'Lembaga/Organisasi']);
            $table->string('no_identitas');
            $table->string('nama_lengkap');
            $table->text('alamat')->nullable();
            $table->string('no_hp');
            $table->string('email')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('file_identitas')->nullable(); // KTP / Surat Kuasa dll
            $table->text('rincian_informasi');
            $table->text('tujuan_penggunaan');
            $table->enum('cara_memperoleh', ['Melihat/Membaca', 'Mendapatkan Salinan Softcopy', 'Mendapatkan Salinan Hardcopy'])->default('Mendapatkan Salinan Softcopy');
            $table->enum('status', ['Menunggu', 'Diproses', 'Selesai', 'Ditolak'])->default('Menunggu');
            $table->text('alasan_penolakan')->nullable();
            $table->string('file_jawaban')->nullable();
            $table->timestamps();

            $table->foreign('opd_id')->references('id')->on('opds')->onDelete('set null');
        });

        Schema::create('ppid_objections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ppid_request_id');
            $table->string('alasan_keberatan');
            $table->text('kasus_posisi');
            $table->enum('status', ['Menunggu', 'Diproses', 'Selesai Sengketa'])->default('Menunggu');
            $table->string('dokumen_keputusan')->nullable();
            $table->text('admin_note')->nullable();
            $table->timestamps();

            $table->foreign('ppid_request_id')->references('id')->on('ppid_requests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppid_objections');
        Schema::dropIfExists('ppid_requests');
    }
};
