<?php

namespace App\Filament\Resources\ProfilOpdResource\Pages;

use App\Filament\Resources\ProfilOpdResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProfilOpd extends CreateRecord
{
    protected static string $resource = ProfilOpdResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['opd_id'] = \App\Filament\Support\OpdFields::getOpdIdForNewRecord($data);
        return $data;
    }
}
