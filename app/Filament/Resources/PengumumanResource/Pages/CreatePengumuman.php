<?php

namespace App\Filament\Resources\PengumumanResource\Pages;

use App\Filament\Resources\PengumumanResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreatePengumuman extends CreateRecord
{
    protected static string $resource = PengumumanResource::class;

    /**
     * Method ini dijalankan setelah data berhasil dibuat.
     * Bisa kamu pakai untuk kirim notifikasi, logging, dll.
     */
    protected function afterCreate(): void
    {
        // Kirim notifikasi ke pengguna setelah data berhasil disimpan
        Notification::make()
            ->title('Pengumuman berhasil dibuat!')
            ->success()
            ->send();
    }

    protected function getRedirectUrl(): string
    {
        return PengumumanResource::getUrl('index');
    }
}
