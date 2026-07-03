<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HalamanStatisResource\Pages;


use App\Models\HalamanStatis;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class HalamanStatisResource extends Resource
{
    protected static ?string $model = HalamanStatis::class;

    // Navigasi
    protected static ?string $navigationIcon = 'heroicon-o-home'; // Ikon default
    protected static ?string $navigationLabel = 'Halaman Statis';
    protected static ?string $pluralModelLabel = 'Halaman Statis';
    protected static ?string $navigationGroup = 'Kelola Konten';
    protected static ?string $slug = 'pages';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('judul')
                ->label('Judul')
                ->required(),

            Forms\Components\TextInput::make('slug')
                ->label('Slug')
                ->required()
                ->live()
                ->afterStateUpdated(function (?string $state, callable $set) {
                    $set('slug', Str::slug($state));
                }),

            ...\App\Filament\Support\OpdFields::form(),


            Forms\Components\FileUpload::make('cover')
                ->label('Cover')
                ->directory('pages')
                ->image()
                ->imagePreviewHeight(150),

            Forms\Components\RichEditor::make('isi')
                ->label('Isi Konten')
                ->required()
                ->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->sortable()
                    ->searchable(),

                ...\App\Filament\Support\OpdFields::tableColumns(),

                Tables\Columns\ImageColumn::make('cover')
                    ->label('Cover')
                    ->height(50),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Update Terakhir')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->defaultSort('updated_at', 'desc')
            ->filters([
                ...\App\Filament\Support\OpdFields::filters(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()->icon('heroicon-o-pencil'),
                    Tables\Actions\DeleteAction::make()->icon('heroicon-o-trash'),
                ])->label('Aksi')->icon('heroicon-o-pencil-square'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->label('Hapus Terpilih'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListHalamanStatis::route('/'),
            'create' => Pages\CreateHalamanStatis::route('/create'),
            'edit'   => Pages\EditHalamanStatis::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return \App\Filament\Support\OpdFields::applyOpdScope(parent::getEloquentQuery());
    }

}
