<?php

namespace App\Filament\Resources\TteFeedbackResource\Pages;

use App\Filament\Resources\TteFeedbackResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTteFeedback extends EditRecord
{
    protected static string $resource = TteFeedbackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
