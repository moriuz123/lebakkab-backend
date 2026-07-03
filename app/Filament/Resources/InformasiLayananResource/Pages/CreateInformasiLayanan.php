<?php

namespace App\Filament\Resources\InformasiLayananResource\Pages;

use App\Filament\Resources\InformasiLayananResource;
use Filament\Resources\Pages\CreateRecord;

class CreateInformasiLayanan extends CreateRecord
{
    protected static string $resource = InformasiLayananResource::class;

    protected function getRedirectUrl(): string
    {
        return InformasiLayananResource::getUrl();
    }
}

