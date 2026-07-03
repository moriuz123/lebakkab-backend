<?php

namespace App\Filament\Resources\VidioResource\Pages;

use App\Filament\Resources\VidioResource;
use App\Filament\Resources\KategoriVidioResource;
use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVidios extends ListRecords
{
    protected static string $resource = VidioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-o-plus')
                ->label('Tambah Vidio')
                ->color('success'),

            Actions\Action::make('Kelola Kategori')
                ->url(KategoriVidioResource::getUrl())
                ->icon('heroicon-o-list-bullet')
                ->color('warning'),
        ];
    }
}
