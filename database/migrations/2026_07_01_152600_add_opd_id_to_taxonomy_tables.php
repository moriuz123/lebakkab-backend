<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected array $tables = [
        'kategoris',
        'kategori_dokumens',
        'kategori_fotos',
        'kategori_vidios',
        'tags'
    ];

    public function up(): void
    {
        foreach ($this->tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (!Schema::hasColumn($tableName, 'opd_id')) {
                    $table->foreignId('opd_id')
                        ->nullable()
                        ->constrained('opds')
                        ->nullOnDelete();
                }
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (Schema::hasColumn($tableName, 'opd_id')) {
                    $table->dropConstrainedForeignId('opd_id');
                }
            });
        }
    }
};
