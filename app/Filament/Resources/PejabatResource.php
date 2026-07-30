<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PejabatResource\Pages;
use App\Models\Pejabat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PejabatResource extends Resource
{
    protected static ?string $model = Pejabat::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    
    protected static ?string $navigationGroup = 'Data Master';
    
    protected static ?string $navigationLabel = 'Data Pejabat';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Profil Pejabat')->schema([
                    Forms\Components\Select::make('kategori_pejabat')
                        ->label('Kategori Pejabat')
                        ->options([
                            'bupati' => 'Bupati',
                            'wakil_bupati' => 'Wakil Bupati',
                            'sekda' => 'Sekretaris Daerah',
                            'kepala_opd' => 'Kepala OPD',
                            'pejabat_opd' => 'Pejabat OPD',
                        ])
                        ->required()
                        ->default('pejabat_opd'),
                    
                    Forms\Components\TextInput::make('nama')
                        ->label('Nama Lengkap (dengan gelar)')
                        ->required(),
                        
                    Forms\Components\TextInput::make('jabatan')
                        ->label('Jabatan')
                        ->required(),
                        
                    Forms\Components\FileUpload::make('foto')
                        ->label('Foto Profil')
                        ->disk('s3')
                        ->directory(\App\Helpers\UploadHelper::getDirectory('pejabat'))
                        ->image()
                        ->helperText('Biarkan kosong jika ingin menggunakan foto default (inisial nama).'),
                ])->columns(2),
                
                Forms\Components\Section::make('Detail Pegawai & Periode')->schema([
                    Forms\Components\TextInput::make('nip')
                        ->label('NIP (opsional)'),
                        
                    Forms\Components\TextInput::make('pangkat_golongan')
                        ->label('Pangkat & Golongan (opsional)'),
                        
                    Forms\Components\TextInput::make('periode')
                        ->label('Periode (opsional, misal: 2024-2029)'),
                        
                    Forms\Components\TextInput::make('sort_order')
                        ->label('Urutan Tampil')
                        ->numeric()
                        ->default(0),
                ])->columns(2),
                
                Forms\Components\Section::make('Riwayat & Lainnya')->schema([
                    Forms\Components\Textarea::make('pesan_singkat')
                        ->label('Pesan Singkat / Quotes (opsional)')
                        ->columnSpanFull(),
                        
                    Forms\Components\RichEditor::make('riwayat_pendidikan')
                        ->label('Riwayat Pendidikan (opsional)')
                        ->columnSpanFull(),
                        
                    Forms\Components\RichEditor::make('riwayat_jabatan')
                        ->label('Riwayat Jabatan (opsional)')
                        ->columnSpanFull(),
                        
                    Forms\Components\Toggle::make('is_active')
                        ->label('Aktif / Masih Menjabat')
                        ->default(true),
                ]),
                
                ...\App\Filament\Support\OpdFields::form(false)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->disk('s3')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->nama) . '&color=FFFFFF&background=0D8ABC'),
                    
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('jabatan')
                    ->label('Jabatan')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('kategori_pejabat')
                    ->label('Kategori')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'bupati' => 'Bupati',
                        'wakil_bupati' => 'Wakil Bupati',
                        'sekda' => 'Sekretaris Daerah',
                        'kepala_opd' => 'Kepala OPD',
                        'pejabat_opd' => 'Pejabat OPD',
                        default => $state,
                    }),
                    
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                    
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
                    
                ...\App\Filament\Support\OpdFields::tableColumns()
            ])
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('kategori_pejabat')
                    ->label('Kategori')
                    ->options([
                        'bupati' => 'Bupati',
                        'wakil_bupati' => 'Wakil Bupati',
                        'sekda' => 'Sekretaris Daerah',
                        'kepala_opd' => 'Kepala OPD',
                        'pejabat_opd' => 'Pejabat OPD',
                    ]),
                ...\App\Filament\Support\OpdFields::filters()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPejabats::route('/'),
            'create' => Pages\CreatePejabat::route('/create'),
            'edit' => Pages\EditPejabat::route('/{record}/edit'),
        ];
    }
    
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return \App\Filament\Support\OpdFields::applyOpdScope(parent::getEloquentQuery());
    }
}
