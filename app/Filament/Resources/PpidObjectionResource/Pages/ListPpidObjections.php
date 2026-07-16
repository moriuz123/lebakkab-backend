<?php

namespace App\Filament\Resources\PpidObjectionResource\Pages;

use App\Filament\Resources\PpidObjectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPpidObjections extends ListRecords
{
    protected static string $resource = PpidObjectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
