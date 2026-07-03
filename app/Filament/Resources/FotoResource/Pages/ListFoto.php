<?php

namespace App\Filament\Resources\FotoResource\Pages;

use App\Filament\Resources\FotoResource;
use App\Filament\Resources\KategoriFotoResource;
use Filament\Actions\CreateAction;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListFoto extends ListRecords
{
    protected static string $resource = FotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Tombol untuk menambah data Foto
            CreateAction::make()
                ->icon('heroicon-o-plus')
                ->label('Tambah Foto')
                ->color('success'),

            // Tombol tambahan untuk menuju ke halaman Kategori Foto
            Action::make('Kelola Kategori') // ← Gunakan Action, bukan CreateAction
                ->url(KategoriFotoResource::getUrl())
                ->icon('heroicon-o-list-bullet')
                ->color('warning'),

        ];
    }
}
