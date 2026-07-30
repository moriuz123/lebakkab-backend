<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class MigrateMediaToOpdFolderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'media:migrate-opd {--rollback : Kembalikan file ke lokasi semula}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Memindahkan file MinIO lama ke dalam folder per-dinas berdasarkan opd_id';

    // Model and the fields that contain media
    protected $models = [
        \App\Models\Berita::class => ['thumbnail'],
        \App\Models\Banner::class => ['gambar'],
        \App\Models\Dokumen::class => ['file_path'],
        \App\Models\Foto::class => ['gambar'],
        \App\Models\HalamanStatis::class => ['cover'],
        \App\Models\HeroSlider::class => ['gambar'],
        \App\Models\InformasiLayanan::class => ['cover'],
        \App\Models\KategoriFoto::class => ['cover'],
        \App\Models\KategoriLayanan::class => ['thumbnail'],
        \App\Models\Pejabat::class => ['foto'],
        \App\Models\Pengumuman::class => ['gambar', 'file_lampiran'],
        \App\Models\ProfilOpd::class => ['struktur_organisasi'],
        \App\Models\TteInfo::class => ['gambar'],
        \App\Models\TteRegistration::class => ['surat_rekomendasi'],
        \App\Models\PpidObjection::class => ['dokumen_keputusan'],
        \App\Models\PpidRequest::class => ['file_identitas', 'file_jawaban'],
        \App\Models\DataAplikasi::class => ['icon'],
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $isRollback = $this->option('rollback');
        $logPath = storage_path('app/media_migration_log.json');
        
        // Disk S3 is usually the one storing media, adjust if needed
        $disk = Storage::disk('s3'); 

        if ($isRollback) {
            $this->info("Memulai proses ROLLBACK migrasi media...");
            if (!file_exists($logPath)) {
                $this->error("File log migrasi tidak ditemukan. Rollback tidak bisa dilakukan.");
                return;
            }

            $logData = json_decode(file_get_contents($logPath), true);
            foreach ($logData as $log) {
                $modelClass = $log['model'];
                $id = $log['id'];
                $field = $log['field'];
                $oldPath = $log['old_path'];
                $newPath = $log['new_path'];
                $isArray = $log['is_array'] ?? false;

                if ($disk->exists($newPath)) {
                    $this->info("Rolling back: $newPath -> $oldPath");
                    $disk->copy($newPath, $oldPath);
                    $model = $modelClass::find($id);
                    if ($model) {
                        $currentData = $model->$field;
                        if ($isArray && is_array($currentData)) {
                            // Replace in array
                            $newArray = array_map(function($p) use ($newPath, $oldPath) {
                                return $p === $newPath ? $oldPath : $p;
                            }, $currentData);
                            $model->update([$field => $newArray]);
                        } else {
                            $model->update([$field => $oldPath]);
                        }
                    }
                    $disk->delete($newPath); // optional: clean up
                } else {
                    $this->warn("File baru tidak ditemukan, lewati: $newPath");
                }
            }
            $this->info("Rollback selesai!");
            return;
        }

        $this->info("Memulai proses MIGRASI media...");
        
        // Load existing log if any to append
        $migrationLog = [];
        if (file_exists($logPath)) {
            $migrationLog = json_decode(file_get_contents($logPath), true) ?? [];
        }

        foreach ($this->models as $modelClass => $fields) {
            if (!class_exists($modelClass)) {
                continue;
            }

            $this->info("Mengecek model: $modelClass");

            // Check if model table has opd_id column
            $modelInstance = new $modelClass();
            if (!Schema::hasColumn($modelInstance->getTable(), 'opd_id')) {
                $this->warn("Model $modelClass tidak memiliki opd_id. Dilewati.");
                continue;
            }

            $records = $modelClass::whereNotNull('opd_id')->get();
            foreach ($records as $record) {
                $opdId = $record->opd_id;
                $prefix = "dinas-$opdId/";

                foreach ($fields as $field) {
                    $currentPath = $record->$field;

                    if (is_array($currentPath)) {
                        $newArray = [];
                        $hasChanges = false;
                        foreach ($currentPath as $path) {
                            if (empty($path) || strpos($path, ltrim($prefix, '/')) === 0) {
                                $newArray[] = $path;
                                continue;
                            }
                            $newPath = $prefix . ltrim($path, '/');
                            if ($disk->exists($path)) {
                                $this->info("Memigrasi array item: $path -> $newPath");
                                $disk->copy($path, $newPath);
                                $newArray[] = $newPath;
                                $hasChanges = true;
                                $migrationLog[] = [
                                    'model' => $modelClass,
                                    'id' => $record->id,
                                    'field' => $field,
                                    'is_array' => true,
                                    'old_path' => $path,
                                    'new_path' => $newPath
                                ];
                                $disk->delete($path);
                            } else {
                                $newArray[] = $path;
                                $this->warn("File tidak ditemukan di disk: $path");
                            }
                        }
                        if ($hasChanges) {
                            $record->update([$field => $newArray]);
                        }
                    } else {
                        // Skip if empty or already has the prefix
                        if (empty($currentPath) || strpos($currentPath, ltrim($prefix, '/')) === 0) {
                            continue;
                        }

                        $newPath = $prefix . ltrim($currentPath, '/');

                        if ($disk->exists($currentPath)) {
                            $this->info("Memigrasi: $currentPath -> $newPath");
                            
                            // Copy file to new destination
                            $disk->copy($currentPath, $newPath);
                            
                            // Update record in database
                            $record->update([$field => $newPath]);

                            // Log for rollback
                            $migrationLog[] = [
                                'model' => $modelClass,
                                'id' => $record->id,
                                'field' => $field,
                                'is_array' => false,
                                'old_path' => $currentPath,
                                'new_path' => $newPath
                            ];

                            // Optionally delete old file
                            $disk->delete($currentPath);
                        } else {
                            $this->warn("File tidak ditemukan di disk: $currentPath");
                        }
                    }
                }
            }
        }

        if (!empty($migrationLog)) {
            file_put_contents($logPath, json_encode($migrationLog, JSON_PRETTY_PRINT));
            $this->info("Log migrasi disimpan di: $logPath");
        } else {
            $this->info("Tidak ada file yang perlu dimigrasi.");
        }

        $this->info("Migrasi selesai!");
    }
}
