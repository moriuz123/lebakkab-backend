<?php

namespace App\Filament\Resources\VidioResource\Pages;

use App\Filament\Resources\VidioResource;
use Filament\Resources\Pages\EditRecord;

class EditVidio extends EditRecord
{
    protected static string $resource = VidioResource::class;
    protected function getRedirectUrl(): string
    {
        return VidioResource::getUrl('index');
    }
}
