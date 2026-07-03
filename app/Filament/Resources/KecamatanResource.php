<?php

namespace App\Filament\Resources;

use App\Models\Kecamatan;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Str;
use App\Filament\Resources\KecamatanResource\Pages;

class KecamatanResource extends Resource
{
    protected static ?string $model = Kecamatan::class;

    protected static ?string $navigationIcon = 'heroicon-s-home-modern';
    protected static ?string $navigationLabel = 'Kecamatan';
    protected static ?string $navigationGroup = 'Kelola Konten';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(3)->schema([
                TextInput::make('nama')
                    ->label('Nama Kecamatan')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state))),

                TextInput::make('slug')
                    ->required()
                    ->disabled()
                    ->dehydrated(),

                TextInput::make('kode_kecamatan')
                    ->label('Kode Kecamatan')
                    ->required(),
                TextInput::make('nama_camat')
                    ->label('Camat'),


                TextInput::make('email')
                    ->label('Email')
                    ->email(),

                TextInput::make('telepon')
                    ->label('Telepon'),

                TextInput::make('website')
                    ->label('Website')
                    ->url(),

                TextInput::make('urutan')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0)
                    ->required(),

                FileUpload::make('logo')
                    ->label('Logo')
                    ->image()
                    ->imageResizeMode('cover')
                    ->imagePreviewHeight(80)
                    ->directory('kecamatan/logo'),

                FileUpload::make('foto_kantor')
                    ->label('Foto Kantor')
                    ->image()
                    ->imageResizeMode('cover')
                    ->imagePreviewHeight(80)
                    ->directory('kecamatan/foto_kantor'),
            ]),

            Grid::make(2)->schema([
                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->maxLength(500),

                Textarea::make('alamat_kantor')
                    ->label('Alamat Kantor')
                    ->rows(3)
                    ->maxLength(500),

                Textarea::make('peta_embed')
                    ->label('Embed Peta (iframe)')
                    ->rows(3)
                    ->maxLength(1000),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto_kantor')
                    ->label('Foto')
                    ->circular()
                    ->height(60),

                TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->limit(25)
                    ->wrap(),

                TextColumn::make('nama_camat')
                    ->label('Camat'),

                TextColumn::make('website')
                    ->label('Website')
                    ->formatStateUsing(fn($state) => $state
                        ? "<a href='{$state}' class='text-primary underline' target='_blank'>Link</a>"
                        : '-')
                    ->html(),

                TextColumn::make('updated_at')
                    ->label('Update Terakhir')
                    ->since(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('urutan')
            ->paginationPageOptions([10, 20, 50]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKecamatans::route('/'),
            'create' => Pages\CreateKecamatan::route('/create'),
            'edit' => Pages\EditKecamatan::route('/{record}/edit'),
        ];
    }
}
