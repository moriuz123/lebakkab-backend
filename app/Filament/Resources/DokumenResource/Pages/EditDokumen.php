<?php

namespace App\Filament\Resources\DokumenResource\Pages;

use App\Filament\Resources\DokumenResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDokumen extends EditRecord
{
    protected static string $resource = DokumenResource::class;

    protected function getRedirectUrl(): string
    {
        return DokumenResource::getUrl('index');
    }

    public function getTitle(): string
    {
        return 'Edit Dokumen';
    }
}
