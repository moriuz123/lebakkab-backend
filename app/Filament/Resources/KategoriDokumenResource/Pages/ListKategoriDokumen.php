<?php

namespace App\Filament\Resources\KategoriDokumenResource\Pages;

use App\Filament\Resources\KategoriDokumenResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class ListKategoriDokumen extends ListRecords
{
    protected static string $resource = KategoriDokumenResource::class;
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-o-plus')
                ->label('Kategori Baru')
                ->color('success')


        ];
    }
}
