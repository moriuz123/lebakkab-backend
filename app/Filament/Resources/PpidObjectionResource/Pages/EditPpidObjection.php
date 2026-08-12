<?php

namespace App\Filament\Resources\PpidObjectionResource\Pages;

use App\Filament\Resources\PpidObjectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPpidObjection extends EditRecord
{
    protected static string $resource = PpidObjectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
