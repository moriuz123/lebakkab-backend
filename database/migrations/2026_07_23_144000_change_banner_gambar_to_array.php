<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Change column to text
        Schema::table('banners', function (Blueprint $table) {
            $table->text('gambar')->nullable()->change();
        });

        // Convert existing string data to JSON array
        DB::statement("UPDATE banners SET gambar = CONCAT('[\"', gambar, '\"]') WHERE gambar IS NOT NULL AND gambar NOT LIKE '[%'");
    }

    public function down(): void
    {
        //
    }
};
