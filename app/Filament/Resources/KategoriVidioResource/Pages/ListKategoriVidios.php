<?php

namespace App\Filament\Resources\KategoriVidioResource\Pages;

use App\Filament\Resources\KategoriVidioResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKategoriVidios extends ListRecords
{
    protected static string $resource = KategoriVidioResource::class;

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
