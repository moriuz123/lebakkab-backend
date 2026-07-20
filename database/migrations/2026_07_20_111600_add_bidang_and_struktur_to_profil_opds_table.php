<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBidangAndStrukturToProfilOpdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profil_opds', function (Blueprint $table) {
            if (!Schema::hasColumn('profil_opds', 'bidang_kerja')) {
                $table->json('bidang_kerja')->nullable()->after('fungsi');
            }
            if (!Schema::hasColumn('profil_opds', 'struktur_organisasi')) {
                $table->string('struktur_organisasi')->nullable()->after('bidang_kerja');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profil_opds', function (Blueprint $table) {
            if (Schema::hasColumn('profil_opds', 'bidang_kerja')) {
                $table->dropColumn('bidang_kerja');
            }
            if (Schema::hasColumn('profil_opds', 'struktur_organisasi')) {
                $table->dropColumn('struktur_organisasi');
            }
        });
    }
}
