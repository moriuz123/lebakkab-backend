<?php

namespace App\Filament\Resources\HeroSliderResource\Pages;

use App\Filament\Resources\HeroSliderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHeroSliders extends ListRecords
{
    protected static string $resource = HeroSliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make() // ✅ Perbaikan: langsung gunakan CreateAction
                ->icon('heroicon-o-plus')
                ->label('Tambah Gambar Hero Slider')
                ->color('success'),

        ];
    }

    public function getTitle(): string
    {
        return 'Data Backround Hero Slider';
    }
}
