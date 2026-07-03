<?php

namespace App\Filament\Resources\DataAplikasiResource\Pages;

use App\Filament\Resources\DataAplikasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataAplikasis extends ListRecords
{

    protected static string $resource = DataAplikasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Data Aplikasi')
                ->icon('heroicon-o-plus')
                ->color('success'),
        ];
    }
    public function getTitle(): string
    {
        return 'Data Aplikasi Pemerintah Kab. Lebak';
    }
}
