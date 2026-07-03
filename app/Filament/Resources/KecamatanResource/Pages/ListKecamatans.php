<?php

namespace App\Filament\Resources\KecamatanResource\Pages;

use App\Filament\Resources\KecamatanResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Actions\CreateAction; // ← ✅ penting

class ListKecamatans extends ListRecords
{
    protected static string $resource = KecamatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-o-plus')
                ->label('Tambah Kecamatan')
                ->color('success'),
        ];
    }

    public function getTitle(): string
    {
        return 'Data Kecamatan Kab. Lebak';
    }
}
