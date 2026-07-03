<?php

namespace App\Filament\Resources\KritikSaranResource\Pages;

use App\Filament\Resources\KritikSaranResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKritikSaran extends EditRecord
{
    protected static string $resource = KritikSaranResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

     protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
