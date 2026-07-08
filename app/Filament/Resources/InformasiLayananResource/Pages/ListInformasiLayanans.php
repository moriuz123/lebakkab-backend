<?php

namespace App\Filament\Resources\InformasiLayananResource\Pages;

use App\Filament\Resources\InformasiLayananResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;
use Filament\Actions\Action;
use App\Filament\Resources\KategoriLayananResource;

class ListInformasiLayanans extends ListRecords
{
    protected static string $resource = InformasiLayananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('kategori_layanan')
                ->label('Kelola Kategori')
                ->icon('heroicon-o-list-bullet')
                ->color('primary')
                ->url(KategoriLayananResource::getUrl('index')),
            CreateAction::make()
                ->icon('heroicon-o-plus')
                ->label('Tambah Layanan')
                ->color('success'),
        ];
    }
}
