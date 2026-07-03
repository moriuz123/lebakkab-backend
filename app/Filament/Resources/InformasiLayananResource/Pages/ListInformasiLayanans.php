<?php

namespace App\Filament\Resources\InformasiLayananResource\Pages;

use App\Filament\Resources\InformasiLayananResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction; // <- Tambahkan ini

class ListInformasiLayanans extends ListRecords
{
    protected static string $resource = InformasiLayananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-o-plus')
                ->label('Tambah Layanan')
                ->color('success'),
        ];
    }
}
