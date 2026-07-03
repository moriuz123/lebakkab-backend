<?php

namespace App\Filament\Resources\DataAplikasiResource\Pages;

use App\Filament\Resources\DataAplikasiResource;
use Filament\Resources\Pages\EditRecord;

class EditDataAplikasi extends EditRecord
{
    protected static string $resource = DataAplikasiResource::class;

    protected function getRedirectUrl(): string
    {
        return static::$resource::getUrl('index');
    }
}
