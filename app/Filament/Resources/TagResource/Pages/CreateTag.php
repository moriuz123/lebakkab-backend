<?php

namespace App\Filament\Resources\TagResource\Pages;

use App\Filament\Resources\TagResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateTag extends CreateRecord
{
    protected static string $resource = TagResource::class;

    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Jika slug dikosongkan, otomatis isi dari nama
        if (empty($data['slug']) && isset($data['nama'])) {
            $data['slug'] = Str::slug($data['nama']);
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        // Redirect ke halaman list tags setelah berhasil membuat
        return TagResource::getUrl();
    }
}
