<?php

namespace App\Filament\Pages;

use App\Models\ProfilDaerah;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;

class ManageProfilDaerah extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?string $navigationLabel = 'Profil Daerah';
    protected static ?string $navigationGroup = 'Data Master';
    protected static string $view = 'filament.pages.manage-profil-daerah';

    public array $data = [];

    public function mount(): void
    {
        $opdId = auth()->user()->opd_id;
        $profil = ProfilDaerah::firstOrNew(['opd_id' => $opdId]);
        $this->form->fill($profil->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Tabs::make('Profil Daerah')->tabs([
                    Tabs\Tab::make('Identitas & Sejarah')->schema([
                        FileUpload::make('gambar_lambang')
                            ->label('Gambar Lambang Daerah')
                            ->disk('s3')
                            ->directory('profil_daerah')
                            ->image(),
                        Textarea::make('arti_lambang')
                            ->label('Arti Lambang Daerah')
                            ->rows(4),
                        RichEditor::make('sejarah_singkat')
                            ->label('Sejarah Singkat')
                            ->columnSpanFull(),
                    ]),
                    
                    Tabs\Tab::make('Visi & Misi')->schema([
                        RichEditor::make('visi_misi')
                            ->label('Visi & Misi Daerah')
                            ->columnSpanFull(),
                    ]),
                    
                    Tabs\Tab::make('Wilayah & Demografi')->schema([
                        RichEditor::make('kondisi_geografis')
                            ->label('Kondisi Geografis & Batas Wilayah')
                            ->columnSpanFull(),
                        RichEditor::make('demografi')
                            ->label('Kependudukan / Demografi')
                            ->columnSpanFull(),
                        RichEditor::make('potensi_daerah')
                            ->label('Potensi Daerah (Pariwisata, Pertanian, dll)')
                            ->columnSpanFull(),
                    ]),
                    
                    Tabs\Tab::make('Peta Lokasi')->schema([
                        Textarea::make('peta_wilayah')
                            ->label('Embed Kode Peta (Google Maps iframe)')
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),
                ])->persistTabInQueryString()
            ]);
    }

    public function save(): void
    {
        $opdId = auth()->user()->opd_id;
        ProfilDaerah::updateOrCreate(
            ['opd_id' => $opdId],
            $this->form->getState()
        );

        Notification::make()
            ->title('Profil Daerah berhasil disimpan.')
            ->success()
            ->send();
    }
}
