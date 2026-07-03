<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VidioResource\Pages;
use App\Models\Vidio;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;

class VidioResource extends Resource
{
    protected static ?string $model = Vidio::class;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';
    protected static ?string $navigationLabel = 'Vidio';
    protected static ?string $modelLabel = 'Vidio';
    protected static ?string $pluralModelLabel = 'Vidio';
    protected static ?string $navigationGroup = 'Galeri';

    public static function form(Form $form): Form
    {
        return $form->schema([
            ...\App\Filament\Support\OpdFields::form(),

            Forms\Components\Select::make('id_kategori_vidio')
                ->label('Kategori Vidio')
                ->relationship('kategori', 'nama_kategori_vidio', fn (\Illuminate\Database\Eloquent\Builder $query) => \App\Filament\Support\OpdFields::applyOpdScope($query))
                ->required(),

            TextInput::make('judul_vidio')
                ->label('Judul')
                ->required()
                ->maxLength(255),

            Textarea::make('keterangan')
                ->label('Keterangan')
                ->rows(3)
                ->maxLength(500),

            TextInput::make('sumber_youtube')
                ->label('ID YouTube')
                ->required()
                ->maxLength(50)
                ->helperText('Contoh: dQw4w9WgXcQ (hanya ID video)'),

            Toggle::make('is_active')
                ->label('Tampilkan')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table


            ->columns([
                ImageColumn::make("thumbnail")
                    ->label("Thumbnail")
                    ->getStateUsing(fn($record) => "https://img.youtube.com/vi/" . $record->sumber_youtube . "/mqdefault.jpg")
                    ->url(fn($record) => "https://www.youtube.com/watch?v=" . $record->sumber_youtube)

                    ->height(70),



                TextColumn::make('judul_vidio')
                    ->label('Judul')
                    ->searchable()
                    ->limit(60)
                    ->wrap(),

                TextColumn::make('kategori.nama_kategori_vidio')
                    ->label('Kategori')
                    ->sortable(),

                ...\App\Filament\Support\OpdFields::tableColumns(),

                IconColumn::make('is_active')
                    ->label('Tampil')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                ...\App\Filament\Support\OpdFields::filters(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVidios::route('/'),
            'create' => Pages\CreateVidio::route('/create'),
            'edit' => Pages\EditVidio::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return \App\Filament\Support\OpdFields::applyOpdScope(parent::getEloquentQuery());
    }

}
