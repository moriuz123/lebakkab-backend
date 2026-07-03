<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriFotoResource\Pages;
use App\Models\KategoriFoto;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Illuminate\Support\Str;

class KategoriFotoResource extends Resource
{
    protected static ?string $model = KategoriFoto::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Kategori Foto';
    protected static ?string $slug = 'kategori-fotos';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->required()
                    ->label('nama Kategori'),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->live()
                    ->afterStateUpdated(function (?string $state, callable $set) {
                        $set('slug', Str::slug($state));
                    }),

                Forms\Components\FileUpload::make('cover')
                    ->label('Gambar Cover')
                    ->image()
                    ->imageEditor()
                    ->directory('kategori-foto')
                    ->required()
                    ->maxSize(1024),
                ...\App\Filament\Support\OpdFields::form(false),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover')
                    ->label('Cover')
                    ->width(100)
                    ->height(60),


                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable(),
                ...\App\Filament\Support\OpdFields::tableColumns(),
            ])
            ->filters([
                ...\App\Filament\Support\OpdFields::filters(),
            ])


            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
                    ->icon('heroicon-m-arrow-right-circle')
                    ->color('danger')
                    ->tooltip('Aksi')
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKategoriFotos::route('/'),
            'create' => Pages\CreateKategoriFoto::route('/create'),
            'edit' => Pages\EditKategoriFoto::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return \App\Filament\Support\OpdFields::applyOpdScope(parent::getEloquentQuery());
    }
}
