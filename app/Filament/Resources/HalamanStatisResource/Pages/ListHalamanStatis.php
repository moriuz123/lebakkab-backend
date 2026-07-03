<?php

namespace App\Filament\Resources\HalamanStatisResource\Pages;

use App\Filament\Resources\HalamanStatisResource;
use Filament\Actions; // ✅ Gunakan ini, bukan Filament\Pages\Actions
use Filament\Resources\Pages\ListRecords;

class ListHalamanStatis extends ListRecords
{
    protected static string $resource = HalamanStatisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Halaman')
                ->icon('heroicon-o-plus')
                ->color('success'),
        ];
    }

    public function getTitle(): string
    {
        return 'Halaman Statis';
    }
}
