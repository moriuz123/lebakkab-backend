<?php

namespace App\Filament\Resources\ProfilOpdResource\Pages;

use App\Filament\Resources\ProfilOpdResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfilOpd extends EditRecord
{
    protected static string $resource = ProfilOpdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
