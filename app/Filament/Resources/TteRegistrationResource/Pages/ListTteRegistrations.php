<?php

namespace App\Filament\Resources\TteRegistrationResource\Pages;

use App\Filament\Resources\TteRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTteRegistrations extends ListRecords
{
    protected static string $resource = TteRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
