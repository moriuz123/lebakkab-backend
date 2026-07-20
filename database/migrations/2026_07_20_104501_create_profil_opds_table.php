<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilOpdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profil_opds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opd_id')->constrained('opds')->cascadeOnDelete();
            $table->text('latar_belakang')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->text('tugas_pokok')->nullable();
            $table->text('fungsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profil_opds');
    }
}
