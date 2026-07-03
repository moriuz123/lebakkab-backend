<?php

namespace App\Filament\Resources\KategoriResource\Pages;

use App\Filament\Resources\KategoriResource;
use Filament\Resources\Pages\ListRecords;

use Filament\Actions\CreateAction;

class ListKategoris extends ListRecords
{
    protected static string $resource = KategoriResource::class;
}
