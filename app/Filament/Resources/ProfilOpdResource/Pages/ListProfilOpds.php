<?php

namespace App\Filament\Resources\ProfilOpdResource\Pages;

use App\Filament\Resources\ProfilOpdResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProfilOpds extends ListRecords
{
    protected static string $resource = ProfilOpdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
