<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use Filament\Resources\Pages\EditRecord;
use App\Models\Setting;
use Filament\Forms;

class EditSetting extends EditRecord
{
    protected static string $resource = SettingResource::class;

    public function mount($record): void
    {
        // Gantikan parameter $record dengan id dari record tunggal
        parent::mount(Setting::firstOrFail()->getKey());
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('site_name')->label('Nama Website')->required(),
            Forms\Components\TextInput::make('site_description')->label('Deskripsi Website'),
            Forms\Components\FileUpload::make('logo')->label('Logo')->directory('settings')->image(),
            Forms\Components\FileUpload::make('favicon')->label('Favicon')->directory('settings')->acceptedFileTypes(['image/x-icon']),
            Forms\Components\TextInput::make('address')->label('Alamat'),
            Forms\Components\TextInput::make('email')->label('Email')->email(),
            Forms\Components\TextInput::make('phone')->label('Telepon'),
            Forms\Components\TextInput::make('whatsapp')->label('WhatsApp'),
            Forms\Components\TextInput::make('facebook'),
            Forms\Components\TextInput::make('instagram'),
            Forms\Components\TextInput::make('twitter'),
            Forms\Components\TextInput::make('youtube'),
            Forms\Components\TextInput::make('footer_text')->label('Teks Footer'),
            Forms\Components\Textarea::make('meta_keywords'),
            Forms\Components\Textarea::make('meta_description'),
            Forms\Components\Toggle::make('maintenance_mode')->label('Mode Pemeliharaan'),
            Forms\Components\TextInput::make('google_analytics_id')->label('Google Analytics ID'),
            Forms\Components\Textarea::make('maps_embed')->label('Embed Peta'),
            Forms\Components\TextInput::make('maps_link')->label('Link Peta'),
            Forms\Components\FileUpload::make('photo_bupati')->label('Foto Bupati')->directory('settings')->image(),
            Forms\Components\FileUpload::make('photo_wakil_bupati')->label('Foto Wakil Bupati')->directory('settings')->image(),
            Forms\Components\TextInput::make('tagline'),
            Forms\Components\FileUpload::make('logo_tagline')->label('Logo Tagline')->directory('settings')->image(),
            Forms\Components\TextInput::make('satuan_kerja')->label('Satuan Kerja'),
        ];
    }
}
