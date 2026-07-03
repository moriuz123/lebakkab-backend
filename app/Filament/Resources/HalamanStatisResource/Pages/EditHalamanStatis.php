<?php

namespace App\Filament\Resources\HalamanStatisResource\Pages;

use App\Filament\Resources\HalamanStatisResource;
use Filament\Resources\Pages\EditRecord;


class EditHalamanStatis extends EditRecord
{
    protected static string $resource = HalamanStatisResource::class;

    protected function getRedirectUrl(): string
    {
        return HalamanStatisResource::getUrl('index');
    }
}
