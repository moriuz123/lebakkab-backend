<?php

namespace App\Filament\Resources\HeroSliderResource\Pages;

use App\Filament\Resources\HeroSliderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHeroSlider extends CreateRecord
{
    protected static string $resource = HeroSliderResource::class;
    protected function getRedirectUrl(): string
    {
        return HeroSliderResource::getUrl('index');
    }

    public function getTitle(): string
    {
        return 'Tambah Backround Hero Sliders';
    }
}
