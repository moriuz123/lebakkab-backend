<?php

namespace App\Filament\Resources\PolingResource\Pages;

use App\Filament\Resources\PolingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPolings extends ListRecords
{
    protected static string $resource = PolingResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
