<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $tables = [
        'beritas',
        'pengumumen',
        'agendas',
        'dokumens',
        'banners',
        'halaman_statis',
        'informasi_layanans',
        'fotos',
        'vidios',
        'data_aplikasis',
    ];

    public function up(): void
    {
        foreach ($this->tables as $tableName) {
            if (! Schema::hasTable($tableName)) {
                continue;
            }

            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (! Schema::hasColumn($tableName, 'opd_id')) {
                    $table->foreignId('opd_id')
                        ->nullable()
                        ->after('id')
                        ->constrained('opds')
                        ->nullOnDelete();
                }

                if (! Schema::hasColumn($tableName, 'tampil_di_portal')) {
                    $table->boolean('tampil_di_portal')
                        ->default(true)
                        ->after('opd_id');
                }
            });
        }
    }

    public function down(): void
    {
        foreach (array_reverse($this->tables) as $tableName) {
            if (! Schema::hasTable($tableName)) {
                continue;
            }

            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (Schema::hasColumn($tableName, 'opd_id')) {
                    $table->dropConstrainedForeignId('opd_id');
                }

                if (Schema::hasColumn($tableName, 'tampil_di_portal')) {
                    $table->dropColumn('tampil_di_portal');
                }
            });
        }
    }
};
