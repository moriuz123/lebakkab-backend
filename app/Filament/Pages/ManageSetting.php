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
        $opdId = auth()->user()->opd_id;
        $setting = Setting::firstOrNew(['opd_id' => $opdId]);
        $this->form->fill($setting->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Tabs::make('Pengaturan')->tabs([
                    Tabs\Tab::make('Umum')->schema([
                        Grid::make(2)->schema([
                            TextInput::make('site_name')->label('Nama Website')->required(),
                            TextInput::make('site_description')->label('Deskripsi Website'),
                            FileUpload::make('logo')->label('Logo')->disk(config('filesystems.default'))->image()->directory('settings')->imagePreviewHeight('100'),
                            FileUpload::make('favicon')->label('Favicon')->disk(config('filesystems.default'))->directory('settings')->acceptedFileTypes([
                                'image/x-icon', 
                                'image/vnd.microsoft.icon', // Seringkali file .ico dibaca sebagai ini oleh server
                                'image/png', 
                                'image/jpeg'
                            ]),
                            TextInput::make('tagline')->label('Tagline'),
                            TextInput::make('satuan_kerja')->label('Satuan Kerja'),
                            FileUpload::make('logo_tagline')->label('Logo Tagline')->disk(config('filesystems.default'))->directory('settings')->image(),
                            FileUpload::make('logo_tagline2')->label('Logo Tagline 2')->disk('s3')->directory('settings')->image(),
                            FileUpload::make('logo_tagline3')->label('Logo Tagline 3')->disk('s3')->directory('settings')->image(),
                            FileUpload::make('backgrounds')->label('Background Hero')->disk('s3')->directory('settings')->image()->multiple()->maxFiles(3),
                        ])
                    ]),
                    Tabs\Tab::make('SEO')->schema([
                        Textarea::make('meta_keywords')->label('Meta Keywords'),
                        Textarea::make('meta_description')->label('Meta Description'),
                        TextInput::make('google_analytics_id')->label('Google Analytics ID'),
                    ]),
                    Tabs\Tab::make('Footer')->schema([
                        TextInput::make('footer_text')->label('Teks Footer'),
                    ]),

                    Tabs\Tab::make('Lainnya')->schema([
                        Toggle::make('maintenance_mode')->label('Mode Pemeliharaan'),
                    ]),
                ])->persistTabInQueryString()
            ]);
    }

    public function save(): void
    {
        $opdId = auth()->user()->opd_id;
        Setting::updateOrCreate(
            ['opd_id' => $opdId],
            $this->form->getState()
        );

        \Illuminate\Support\Facades\Cache::forget('settings.header.' . ($opdId ?? 'global'));
        \Illuminate\Support\Facades\Cache::forget('settings.footer.' . ($opdId ?? 'global'));
        \Illuminate\Support\Facades\Cache::forget('settings.header.global');
        \Illuminate\Support\Facades\Cache::forget('settings.footer.global');

        Notification::make()
            ->title('Pengaturan berhasil disimpan.')
            ->success()
            ->send();
    }
}
