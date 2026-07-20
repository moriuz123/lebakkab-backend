<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKontakAndSosmedToProfilDaerahsTable extends Migration
{
    public function up()
    {
        Schema::table('profil_daerahs', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->string('whatsapp')->nullable();
            $table->text('alamat')->nullable();
            $table->string('website')->nullable();
            $table->json('social_media')->nullable();
        });
    }

    public function down()
    {
        Schema::table('profil_daerahs', function (Blueprint $table) {
            $table->dropColumn(['email', 'telepon', 'whatsapp', 'alamat', 'website', 'social_media']);
        });
    }
}
