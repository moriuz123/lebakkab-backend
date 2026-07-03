<?php

namespace App\Filament\Resources\DokumenResource\Pages;

use App\Filament\Resources\DokumenResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDokumen extends CreateRecord
{
    protected static string $resource = DokumenResource::class;

    protected function getRedirectUrl(): string
    {
        return DokumenResource::getUrl('index');
    }
    public function getTitle(): string
    {
        return 'Tambah Dokumen';
    }
}
