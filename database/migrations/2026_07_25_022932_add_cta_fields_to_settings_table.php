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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('cta_text')->nullable();
            $table->string('cta_link_type')->nullable(); // e.g., 'modul' or 'eksternal'
            $table->string('cta_link_ref')->nullable();  // slug of the module if applicable
            $table->string('cta_url')->nullable();       // full URL if external
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['cta_text', 'cta_link_type', 'cta_link_ref', 'cta_url']);
        });
    }
};
