<?php

namespace App\Filament\Resources\TteInfoResource\Pages;

use App\Filament\Resources\TteInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTteInfos extends ListRecords
{
    protected static string $resource = TteInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
