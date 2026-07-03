<?php

namespace App\Filament\Resources;

use App\Models\DataAplikasi;

use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\DataAplikasiResource\Pages;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;

use Filament\Tables\Enums\FiltersLayout;


class DataAplikasiResource extends Resource
{
    protected static ?string $model = DataAplikasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-window';
    protected static ?string $navigationLabel = 'Data Aplikasi';
    protected static ?string $navigationGroup = 'Kelola Konten';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nama')
                ->label('Nama Aplikasi')
                ->required(),

            ...\App\Filament\Support\OpdFields::form(),

            Select::make('jenis')
                ->label('Jenis Aplikasi')
                ->options([
                    'Website' => 'Website',
                    'Mobile' => 'Mobile',
                ])
                ->required(),

            Select::make('kategori')
                ->label('Kategori')
                ->options([
                    'Aplikasi Layanan Publik' => 'Aplikasi Layanan Publik',
                    'Internal Pemerintah' => 'Internal Pemerintah',
                ])
                ->required(),

            Textarea::make('deskripsi')
                ->label('Deskripsi'),

            TextInput::make('link')
                ->label('Link Aplikasi')
                ->url()
                ->suffixIcon('heroicon-s-arrow-top-right-on-square')
                ->afterStateUpdated(function ($state, callable $set) {
                    if ($state && ! str_starts_with($state, 'http://') && ! str_starts_with($state, 'https://')) {
                        $set('link', 'https://' . ltrim($state, '/'));
                    }
                }),

            FileUpload::make('icon')
                ->label('Upload Icon (.webp / .png)')
                ->image()
                ->imageEditor()
                ->imagePreviewHeight('60')
                ->directory('aplikasi/icons')
                ->acceptedFileTypes(['image/webp', 'image/png'])
                ->required(),

            TextInput::make('opd_pelaksana')
                ->label('OPD Pelaksana')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('icon')
                    ->label('Icon')
                    ->disk('public')
                    ->height(40)
                    ->width(40),

                TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jenis')
                    ->label('Jenis')
                    ->sortable(),

                TextColumn::make('kategori')
                    ->label('Kategori')
                    ->sortable(),

                TextColumn::make('opd_pelaksana')
                    ->label('OPD Pelaksana')
                    ->wrap(),

                ...\App\Filament\Support\OpdFields::tableColumns(),

                TextColumn::make('link')
                    ->label('Link')
                    ->url(fn($record) => $record->link, true)
                    ->openUrlInNewTab()
                    ->limit(30),

            ])
            ->defaultSort('updated_at', 'desc')

            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
                    ->icon('heroicon-o-pencil-square')
                    ->color('danger')
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])

            ->filters([
                ...\App\Filament\Support\OpdFields::filters(),

                SelectFilter::make('jenis')
                    ->label('Jenis')
                    ->options([
                        'Mobile' => 'Mobile',
                        'Website' => 'Website',
                    ])
                    ->attribute('jenis'),

                SelectFilter::make('kategori')
                    ->label('Kategori')
                    ->options(function () {
                        return \App\Models\DataAplikasi::query()
                            ->select('kategori')
                            ->distinct()
                            ->pluck('kategori', 'kategori')
                            ->toArray();
                    })
                    ->searchable(),

                SelectFilter::make('opd_pelaksana')
                    ->label('OPD Pelaksana')
                    ->options(function () {
                        return \App\Models\DataAplikasi::query()
                            ->select('opd_pelaksana')
                            ->distinct()
                            ->pluck('opd_pelaksana', 'opd_pelaksana')
                            ->toArray();
                    })
                    ->searchable()
            ], layout: FiltersLayout::AboveContent);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDataAplikasis::route('/'),
            'create' => Pages\CreateDataAplikasi::route('/create'),
            'edit' => Pages\EditDataAplikasi::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return \App\Filament\Support\OpdFields::applyOpdScope(parent::getEloquentQuery());
    }

}
