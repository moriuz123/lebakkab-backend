<?php

namespace App\Filament\Resources\KategoriDokumenResource\Pages;

use App\Filament\Resources\KategoriDokumenResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKategoriDokumen extends CreateRecord
{
    protected static string $resource = KategoriDokumenResource::class;
    protected function getRedirectUrl(): string
    {
        return KategoriDokumenResource::getUrl('index');
    }
}
