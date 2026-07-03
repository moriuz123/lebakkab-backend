<?php

namespace App\Filament\Resources\BeritaResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\BeritaResource;

class CreateBerita extends CreateRecord
{
    protected static string $resource = BeritaResource::class;
    protected function getRedirectUrl(): string
    {
        return BeritaResource::getUrl('index');
    }
}
