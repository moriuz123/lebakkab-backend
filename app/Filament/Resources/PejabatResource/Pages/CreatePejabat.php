<?php

namespace App\Filament\Resources\PejabatResource\Pages;

use App\Filament\Resources\PejabatResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePejabat extends CreateRecord
{
    protected static string $resource = PejabatResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['opd_id'] = \App\Filament\Support\OpdFields::getOpdIdForNewRecord($data);
        return $data;
    }
}
