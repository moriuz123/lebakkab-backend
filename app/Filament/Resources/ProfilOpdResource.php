<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfilOpdResource\Pages;
use App\Filament\Resources\ProfilOpdResource\RelationManagers;
use App\Models\ProfilOpd;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfilOpdResource extends Resource
{
    protected static ?string $model = ProfilOpd::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Profil OPD';
    protected static ?string $slug = 'profil-opd';
    protected static ?string $navigationGroup = 'Data Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                ...\App\Filament\Support\OpdFields::form(false),
                Forms\Components\Textarea::make('latar_belakang')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('visi')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('misi')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('tugas_pokok')
                    ->label('Tugas Pokok & Fungsi')
                    ->columnSpanFull(),
                
                Forms\Components\Repeater::make('bidang_kerja')
                    ->label('Daftar Bidang Kerja')
                    ->schema([
                        Forms\Components\TextInput::make('nama_bidang')
                            ->label('Nama Bidang')
                            ->required(),
                        Forms\Components\Textarea::make('tugas_pokok')
                            ->label('Tugas Pokok & Fungsi Bidang')
                            ->required(),
                    ])
                    ->columns(1)
                    ->addActionLabel('Tambah Bidang Kerja')
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('struktur_organisasi')
                    ->label('Gambar Struktur Organisasi')
                    ->disk('s3')
                    ->directory(\App\Helpers\UploadHelper::getDirectory('struktur_organisasi'))
                    ->image()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('opd.nama')
                    ->label('OPD')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListProfilOpds::route('/'),
            'create' => Pages\CreateProfilOpd::route('/create'),
            'edit' => Pages\EditProfilOpd::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return \App\Filament\Support\OpdFields::applyOpdScope(parent::getEloquentQuery());
    }
}
