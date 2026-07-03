<?php

namespace App\Filament\Resources\DokumenResource\Pages;

use App\Filament\Resources\DokumenResource;
use App\Filament\Resources\KategoriDokumenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;

class ListDokumens extends ListRecords
{
    protected static string $resource = DokumenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus')
                ->label('Buat Dokumen')
                ->color('success'),
            Action::make('Kelola Kategori')
                ->url(KategoriDokumenResource::getUrl())
                ->icon('heroicon-o-list-bullet')
                ->color('warning'),
        ];
    }

    public function getTitle(): string
    {
        return 'Dokumen Pemerintahan';
    }
}
