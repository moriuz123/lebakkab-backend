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
            Forms\Components\FileUpload::make('logo')
                ->disk('s3')->label('Logo')->directory('settings')->image(),
            Forms\Components\FileUpload::make('favicon')
                ->disk('s3')->label('Favicon')->directory('settings')->acceptedFileTypes(['image/x-icon']),
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
            Forms\Components\TextInput::make('tagline'),
            Forms\Components\FileUpload::make('logo_tagline')
                ->disk('s3')->label('Logo Tagline')->directory('settings')->image(),
            Forms\Components\TextInput::make('satuan_kerja')->label('Satuan Kerja'),
            Forms\Components\FileUpload::make('logo_hero')
                ->disk('s3')->label('Logo Hero')->directory('settings')->image(),
            Forms\Components\FileUpload::make('logo_tagline2')
                ->disk('s3')->label('Logo Tagline 2')->directory('settings')->image(),
            Forms\Components\FileUpload::make('logo_tagline3')
                ->disk('s3')->label('Logo Tagline 3')->directory('settings')->image(),
            Forms\Components\Section::make('Pengaturan Tombol CTA Header')->schema([
                Forms\Components\TextInput::make('cta_text')
                    ->label('Teks Tombol CTA')
                    ->placeholder('Contoh: Lapor Sekarang!'),
                Forms\Components\Select::make('cta_link_type')
                    ->label('Tipe Link CTA')
                    ->options([
                        \App\Models\Menu::LINK_MODUL => 'Modul Internal',
                        \App\Models\Menu::LINK_EKSTERNAL => 'Eksternal',
                    ])
                    ->reactive(),
                Forms\Components\Select::make('cta_link_ref')
                    ->label('Pilih Modul')
                    ->options([
                        'profil-daerah' => 'Profil Kabupaten',
                        'profil-opd' => 'Profil OPD',
                        'pejabat' => 'Data Pejabat',
                        'aplikasi' => 'Data Aplikasi',
                        'pengumuman' => 'Pengumuman',
                        'agenda' => 'Agenda Pemerintahan',
                        'opd' => 'OPD',
                        'layanan' => 'Info Layanan',
                        'berita' => 'Semua Berita',
                        'dokumen' => 'Semua Dokumen',
                        'spon-tte' => 'Modul SPON TTE',
                        'ppid' => 'Modul PPID',
                    ])
                    ->hidden(fn($get) => $get('cta_link_type') !== \App\Models\Menu::LINK_MODUL),
                Forms\Components\TextInput::make('cta_url')
                    ->label('URL Eksternal')
                    ->url()
                    ->hidden(fn($get) => $get('cta_link_type') !== \App\Models\Menu::LINK_EKSTERNAL),
            ]),
        ];
    }
}
