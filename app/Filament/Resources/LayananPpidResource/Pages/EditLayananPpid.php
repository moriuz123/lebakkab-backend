<?php

namespace App\Filament\Resources\LayananPpidResource\Pages;

use App\Filament\Resources\LayananPpidResource;
use App\Models\LayananPpid;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLayananPpid extends EditRecord
{
    protected static string $resource = LayananPpidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['sumber_link_type']) && $data['sumber_link_type'] === LayananPpid::TYPE_LINK_EKSTERNAL) {
            $data['link_ref'] = $data['link_ref_external'] ?? null;
        }
        unset($data['link_ref_external']);
        
        return $data;
    }
}
