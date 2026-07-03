<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriVidioResource\Pages;
use App\Models\KategoriVidio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Support\Str;

class KategoriVidioResource extends Resource
{
    protected static ?string $model = KategoriVidio::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Kategori Vidio';
    protected static ?string $pluralModelLabel = 'Kategori Vidio';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_kategori_vidio')
                    ->required()
                    ->maxLength(255)
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug_kategori_vidio', Str::slug($state));
                    }),

                Forms\Components\TextInput::make('slug_kategori_vidio')
                    ->required()
                    ->maxLength(255),
                ...\App\Filament\Support\OpdFields::form(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_kategori_vidio')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('nama_kategori_vidio')->label('Nama')->searchable(),
                Tables\Columns\TextColumn::make('slug_kategori_vidio')->label('Slug')->searchable(),
                ...\App\Filament\Support\OpdFields::tableColumns(),
            ])
            ->filters([
                ...\App\Filament\Support\OpdFields::filters(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false; // Menyembunyikan menu dari sidebar
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKategoriVidios::route('/'),
            'create' => Pages\CreateKategoriVidio::route('/create'),
            'edit' => Pages\EditKategoriVidio::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return \App\Filament\Support\OpdFields::applyOpdScope(parent::getEloquentQuery());
    }
}
