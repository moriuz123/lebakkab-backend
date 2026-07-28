<?php

namespace App\Filament\Resources\LayananPpidResource\Pages;

use App\Filament\Resources\LayananPpidResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLayananPpids extends ListRecords
{
    protected static string $resource = LayananPpidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
