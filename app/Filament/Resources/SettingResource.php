<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages\EditSetting;
use App\Models\Setting;
use Filament\Resources\Resource;


class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationLabel = 'Pengaturan';
    protected static ?string $navigationGroup = 'Manajemen Situs';
    protected static ?int $navigationSort = 100;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
 public static function getNavigationUrl(): string
{
    return static::getUrl('edit');
}
    public static function getPages(): array
    {
        return [
            'edit' => EditSetting::route('/edit'),
        ];
    }

    
   

}
