<?php

namespace App\Filament\Resources\KategoriVidioResource\Pages;

use App\Filament\Resources\KategoriVidioResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriVidio extends EditRecord
{
    protected static string $resource = KategoriVidioResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
