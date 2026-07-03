<?php

namespace App\Filament\Resources\VidioResource\Pages;

use App\Filament\Resources\VidioResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVidio extends CreateRecord
{
    protected static string $resource = VidioResource::class;
     protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
