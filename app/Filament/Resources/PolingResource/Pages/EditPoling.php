<?php

namespace App\Filament\Resources\PolingResource\Pages;

use App\Filament\Resources\PolingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPoling extends EditRecord
{
    protected static string $resource = PolingResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
