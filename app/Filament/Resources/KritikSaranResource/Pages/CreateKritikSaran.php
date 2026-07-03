<?php

namespace App\Filament\Resources\KritikSaranResource\Pages;

use App\Filament\Resources\KritikSaranResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKritikSaran extends CreateRecord
{
    protected static string $resource = KritikSaranResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
