<?php

namespace App\Filament\Resources\KategoriFotoResource\Pages;

use App\Filament\Resources\KategoriFotoResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class ListKategoriFotos extends ListRecords
{
    protected static string $resource = KategoriFotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-o-plus')
                ->label('Buat Kategori')
                ->color('success')


        ];
    }
}
