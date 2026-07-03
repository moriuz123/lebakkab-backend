<?php

namespace App\Filament\Resources\OpdResource\Pages;

use App\Filament\Resources\OpdResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;

class ListOpds extends ListRecords
{
    protected static string $resource = OpdResource::class;
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-o-plus')
                ->label('Tambah OPD')
                ->color('success')


        ];
    }

    public function getTitle(): string
    {
        return 'Data OPD';
    }
}
