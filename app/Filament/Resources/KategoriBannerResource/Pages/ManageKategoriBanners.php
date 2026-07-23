<?php

namespace App\Filament\Resources\KategoriBannerResource\Pages;

use App\Filament\Resources\KategoriBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKategoriBanners extends ManageRecords
{
    protected static string $resource = KategoriBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
