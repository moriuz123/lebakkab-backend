<?php

namespace App\Filament\Resources\BeritaResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\BeritaResource;
use App\Filament\Resources\KategoriResource;

class ListBeritas extends ListRecords
{
    protected static string $resource = BeritaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus')
                ->label('Tambah Berita')
                ->color('success'),

            Actions\Action::make('Kelola Kategori') // ← Gunakan Action, bukan CreateAction
                ->url(KategoriResource::getUrl())
                ->icon('heroicon-o-list-bullet')
                ->color('warning'),
        ];
    }
}
