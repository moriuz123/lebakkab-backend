<?php

namespace App\Filament\Resources\FotoResource\Pages;

use App\Filament\Resources\FotoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFoto extends CreateRecord
{
    protected static string $resource = FotoResource::class;

    protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}

}
