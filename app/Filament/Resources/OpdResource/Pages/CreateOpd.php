<?php

namespace App\Filament\Resources\OpdResource\Pages;

use App\Filament\Resources\OpdResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOpd extends CreateRecord
{
    protected static string $resource = OpdResource::class;

    protected function getRedirectUrl(): string
    {
        return static::$resource::getUrl('index');
    }

    public function getTitle(): string
    {
        return 'Tambah data OPD';
    }
}
