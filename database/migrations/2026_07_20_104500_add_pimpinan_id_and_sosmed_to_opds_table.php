<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPimpinanIdAndSosmedToOpdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('opds', function (Blueprint $table) {
            if (!Schema::hasColumn('opds', 'pimpinan_id')) {
                $table->foreignId('pimpinan_id')->nullable()->constrained('pejabats')->nullOnDelete();
            }
            if (!Schema::hasColumn('opds', 'social_media')) {
                $table->json('social_media')->nullable()->after('alamat');
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
        Schema::table('opds', function (Blueprint $table) {
            if (Schema::hasColumn('opds', 'pimpinan_id')) {
                $table->dropForeign(['pimpinan_id']);
                $table->dropColumn('pimpinan_id');
            }
            if (Schema::hasColumn('opds', 'social_media')) {
                $table->dropColumn('social_media');
            }
        });
    }
}
