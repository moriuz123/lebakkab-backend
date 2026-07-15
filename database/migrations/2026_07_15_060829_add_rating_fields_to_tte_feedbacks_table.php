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
        Schema::table('tte_feedbacks', function (Blueprint $table) {
            $table->integer('rating_kemudahan')->nullable()->after('rating');
            $table->integer('rating_kecepatan')->nullable()->after('rating_kemudahan');
            $table->integer('rating_kejelasan')->nullable()->after('rating_kecepatan');
            $table->integer('rating_pelayanan')->nullable()->after('rating_kejelasan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tte_feedbacks', function (Blueprint $table) {
            $table->dropColumn([
                'rating_kemudahan',
                'rating_kecepatan',
                'rating_kejelasan',
                'rating_pelayanan',
            ]);
        });
    }
};
