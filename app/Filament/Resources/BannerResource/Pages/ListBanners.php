<?php

namespace App\Filament\Resources\BannerResource\Pages;

use App\Filament\Resources\BannerResource;
use Filament\Resources\Pages\ListRecords;

use Filament\Actions\CreateAction;
use Filament\Actions\Action;
class ListBanners extends ListRecords
{
    protected static string $resource = BannerResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Action::make('kelolaKategori')
                ->label('Kelola Kategori')
                ->icon('heroicon-o-tag')
                ->color('gray')
                ->url(fn () => \App\Filament\Resources\KategoriBannerResource::getUrl('index')),
            CreateAction::make()
                ->icon('heroicon-o-plus')
                ->label('Tambah Banner')
                ->color('success')
        ];
    }
    public function getTitle(): string
    {
        return 'Data Banner';
    }
}
