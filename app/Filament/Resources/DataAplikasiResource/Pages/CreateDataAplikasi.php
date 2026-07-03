<?php

namespace App\Filament\Resources\DataAplikasiResource\Pages;

use App\Filament\Resources\DataAplikasiResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDataAplikasi extends CreateRecord
{
    protected static string $resource = DataAplikasiResource::class;

    protected function getRedirectUrl(): string
    {
        return static::$resource::getUrl('index');
    }

    public function getTitle(): string
    {
        return 'Tambah Aplikasi Baru';
    }
}
