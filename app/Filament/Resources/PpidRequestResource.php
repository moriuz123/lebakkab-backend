<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PpidRequestResource\Pages;
use App\Filament\Resources\PpidRequestResource\RelationManagers;
use App\Models\PpidRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PpidRequestResource extends Resource
{
    protected static ?string $model = PpidRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-magnifying-glass';
    protected static ?string $navigationGroup = 'Layanan PPID';
    protected static ?string $modelLabel = 'Permohonan Informasi';
    protected static ?string $pluralModelLabel = 'Permohonan Informasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make([
                    Forms\Components\Section::make('Informasi Pemohon')
                        ->schema([
                            Forms\Components\Select::make('opd_id')
                                ->label('Tujuan OPD')
                                ->relationship('opd', 'nama', fn (\Illuminate\Database\Eloquent\Builder $query) => \App\Filament\Support\OpdFields::applyOpdScope($query))
                                ->searchable()
                                ->preload(),
                            Forms\Components\TextInput::make('kode_registrasi')
                                ->label('Nomor Registrasi')
                                ->default('PPID-' . date('Ymd') . '-' . rand(1000, 9999))
                                ->required()
                                ->readOnly()
                                ->maxLength(255),
                            Forms\Components\Select::make('kategori_pemohon')
                                ->options([
                                    'Perorangan' => 'Perorangan',
                                    'Lembaga/Organisasi' => 'Lembaga/Organisasi',
                                ])
                                ->required(),
                            Forms\Components\TextInput::make('no_identitas')
                                ->label('NIK / No Identitas')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('nama_lengkap')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\Textarea::make('alamat')
                                ->columnSpanFull(),
                            Forms\Components\TextInput::make('no_hp')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('email')
                                ->email()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('pekerjaan')
                                ->maxLength(255),
                            Forms\Components\FileUpload::make('file_identitas')
                                ->label('File Identitas (KTP/SK)')
                                ->directory('ppid/identitas')
                                ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png']),
                        ])->columns(2),
                ])->columnSpan(2),
                
                Forms\Components\Group::make([
                    Forms\Components\Section::make('Rincian & Status')
                        ->schema([
                            Forms\Components\Textarea::make('rincian_informasi')
                                ->required()
                                ->columnSpanFull(),
                            Forms\Components\Textarea::make('tujuan_penggunaan')
                                ->required()
                                ->columnSpanFull(),
                            Forms\Components\Select::make('cara_memperoleh')
                                ->options([
                                    'Melihat/Membaca' => 'Melihat/Membaca',
                                    'Mendapatkan Salinan Softcopy' => 'Mendapatkan Salinan Softcopy',
                                    'Mendapatkan Salinan Hardcopy' => 'Mendapatkan Salinan Hardcopy',
                                ])
                                ->required(),
                            Forms\Components\Select::make('status')
                                ->options([
                                    'Menunggu' => 'Menunggu',
                                    'Diproses' => 'Diproses',
                                    'Selesai' => 'Selesai',
                                    'Ditolak' => 'Ditolak',
                                ])
                                ->required(),
                            Forms\Components\Textarea::make('alasan_penolakan')
                                ->columnSpanFull(),
                            Forms\Components\FileUpload::make('file_jawaban')
                                ->label('File Jawaban (Jika Selesai)')
                                ->directory('ppid/jawaban')
                                ->acceptedFileTypes(['application/pdf', 'application/zip']),
                        ]),
                ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_registrasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('opd.nama')
                    ->label('Tujuan OPD')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategori_pemohon'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'Menunggu',
                        'primary' => 'Diproses',
                        'success' => 'Selesai',
                        'danger' => 'Ditolak',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                ...\App\Filament\Support\OpdFields::filters(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPpidRequests::route('/'),
            'create' => Pages\CreatePpidRequest::route('/create'),
            'edit' => Pages\EditPpidRequest::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        return \App\Filament\Support\OpdFields::applyOpdScope($query);
    }
}
