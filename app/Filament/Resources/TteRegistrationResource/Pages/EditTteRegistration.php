<?php

namespace App\Filament\Resources\TteRegistrationResource\Pages;

use App\Filament\Resources\TteRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTteRegistration extends EditRecord
{
    protected static string $resource = TteRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
