<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Grid;

class ManageSetting extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationLabel = 'Pengaturan';
    protected static ?string $navigationGroup = 'Manajemen Situs';
    protected static string $view = 'filament.pages.manage-setting';

    public array $data = [];

    public function mount(): void
    {
        $this->form->fill(
            Setting::firstOrNew()->toArray()
        );
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Tabs::make('Pengaturan')->tabs([
                    Tabs\Tab::make('Umum')->schema([
                        TextInput::make('site_name')->label('Nama Website')->required(),
                        TextInput::make('site_description')->label('Deskripsi Website'),
                        FileUpload::make('logo')->label('Logo')->image()->directory('settings')->imagePreviewHeight('100'),
                        FileUpload::make('favicon')->label('Favicon')->directory('settings')->acceptedFileTypes([
        'image/x-icon', 
        'image/vnd.microsoft.icon', // Seringkali file .ico dibaca sebagai ini oleh server
        'image/png', 
        'image/jpeg'
    ]),
                    ]),
                    Tabs\Tab::make('Kontak')->schema([
                        TextInput::make('address')->label('Alamat'),
                        TextInput::make('email')->label('Email')->email(),
                        TextInput::make('phone')->label('Telepon'),
                        TextInput::make('whatsapp')->label('WhatsApp'),
                    ]),
                    Tabs\Tab::make('Sosial Media')->schema([
                        TextInput::make('facebook')->label('Facebook'),
                        TextInput::make('instagram')->label('Instagram'),
                        TextInput::make('twitter')->label('Twitter'),
                        TextInput::make('youtube')->label('YouTube'),
                    ]),
                    Tabs\Tab::make('SEO & Footer')->schema([
                        TextInput::make('footer_text')->label('Teks Footer'),
                        Textarea::make('meta_keywords')->label('Meta Keywords'),
                        Textarea::make('meta_description')->label('Meta Description'),
                        TextInput::make('google_analytics_id')->label('Google Analytics ID'),
                    ]),
                    Tabs\Tab::make('Peta & Lokasi')->schema([
                        Textarea::make('maps_embed')->label('Embed Peta'),
                        TextInput::make('maps_link')->label('Link Peta'),
                    ]),
                    Tabs\Tab::make('Pejabat')->schema([
                        Grid::make(3)->schema([
                            FileUpload::make('photo_bupati')->label('Foto Bupati')->directory('settings')->image(),
                            FileUpload::make('logo_tagline')->label('Logo Tagline')->directory('settings')->image(),
                            FileUpload::make('photo_wakil_bupati')->label('Foto Wakil Bupati')->directory('settings')->image(),
                            TextInput::make('tagline')->label('Tagline'),
                            TextInput::make('satuan_kerja')->label('Satuan Kerja'),



                        ]),


                    ]),
                    Tabs\Tab::make('Lainnya')->schema([
                        Toggle::make('maintenance_mode')->label('Mode Pemeliharaan'),
                    ]),
                ])->persistTabInQueryString()
            ]);
    }

    public function save(): void
    {
        Setting::updateOrCreate(
            ['id' => Setting::first()?->id ?? 1],
            $this->form->getState()
        );

        Notification::make()
            ->title('Pengaturan berhasil disimpan.')
            ->success()
            ->send();
    }
}
