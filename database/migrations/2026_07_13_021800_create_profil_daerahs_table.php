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
        Schema::create('profil_daerahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opd_id')->nullable()->constrained('opds')->nullOnDelete();
            $table->longText('sejarah_singkat')->nullable();
            $table->longText('visi_misi')->nullable();
            $table->text('arti_lambang')->nullable();
            $table->string('gambar_lambang')->nullable();
            $table->longText('kondisi_geografis')->nullable();
            $table->longText('demografi')->nullable();
            $table->longText('potensi_daerah')->nullable();
            $table->text('peta_wilayah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_daerahs');
    }
};
