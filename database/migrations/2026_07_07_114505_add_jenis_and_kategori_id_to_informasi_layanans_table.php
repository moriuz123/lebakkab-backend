<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('informasi_layanans', function (Blueprint $table) {
            $table->string('jenis')->nullable()->after('judul');
            $table->foreignId('kategori_layanan_id')->nullable()->constrained('kategori_layanans')->nullOnDelete()->after('jenis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('informasi_layanans', function (Blueprint $table) {
            $table->dropForeign(['kategori_layanan_id']);
            $table->dropColumn('kategori_layanan_id');
            $table->dropColumn('jenis');
        });
    }
};
