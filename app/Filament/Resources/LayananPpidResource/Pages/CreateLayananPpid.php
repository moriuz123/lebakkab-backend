<?php

namespace App\Filament\Resources\LayananPpidResource\Pages;

use App\Filament\Resources\LayananPpidResource;
use App\Models\LayananPpid;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLayananPpid extends CreateRecord
{
    protected static string $resource = LayananPpidResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (isset($data['sumber_link_type']) && $data['sumber_link_type'] === LayananPpid::TYPE_LINK_EKSTERNAL) {
            $data['link_ref'] = $data['link_ref_external'] ?? null;
        }
        unset($data['link_ref_external']);
        
        $data['opd_id'] = auth()->user()->hasRole('super_admin') ? null : auth()->user()->opd_id;
        
        return $data;
    }
}
