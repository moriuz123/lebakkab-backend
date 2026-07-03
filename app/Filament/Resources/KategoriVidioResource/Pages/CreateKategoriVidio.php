<?php

namespace App\Filament\Resources\KategoriVidioResource\Pages;

use App\Filament\Resources\KategoriVidioResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKategoriVidio extends CreateRecord
{
    protected static string $resource = KategoriVidioResource::class;
     protected function getRedirectUrl(): string
    {
        // Redirect ke halaman list kategori vidio setelah berhasil create
        return $this->getResource()::getUrl('index');
    }
}

