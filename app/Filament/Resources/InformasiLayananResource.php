<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InformasiLayananResource\Pages;
use App\Models\InformasiLayanan;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\RichEditor;
use Illuminate\Support\Facades\Storage;

class InformasiLayananResource extends Resource
{
    protected static ?string $model = InformasiLayanan::class;
    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationLabel = 'Informasi Layanan';
    protected static ?string $navigationGroup = 'Kelola Konten';
    protected static ?string $slug = 'informasi-layanan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('judul')
                ->label('Judul')
                ->required()
                ->maxLength(200),

            // TextInput::make('slug')
            //     ->label('Slug')
            //     ->required()
            //     ->helperText('Salin saja dari judul')
            //     ->live(onBlur: true)
            //     ->afterStateUpdated(function (\Filament\Forms\Set $set, $state) {
            //         $slug = str($state)->slug()->toString();
            //         $set('slug', $slug);
            //     }),

            TextInput::make('slug')
                ->label('Slug')
                ->required()
                ->rules(['required', 'string', 'max:255'])
                ->helperText('Salin saja dari judul')
                ->live(onBlur: true)
                ->afterStateUpdated(function (\Filament\Forms\Set $set, $state) {
                    $slug = str($state)->slug()->toString();
                    $set('slug', $slug);
                }),

            ...\App\Filament\Support\OpdFields::form(),

            RichEditor::make('deskripsi')
                ->label('Deskripsi')
                ->required()
                ->columnSpanFull(),

            FileUpload::make('cover')
                ->label('Cover')
                ->image()
                ->required()
                ->directory('informasi-layanan')
                ->visibility('public'),

            TextInput::make('kontak')
                ->label('Kontak')
                ->maxLength(255),

            TextInput::make('unit_pelaksana')
                ->label('Unit Pelaksana')
                ->maxLength(255),

            Select::make('status')
                ->label('Status')
                ->options([
                    'aktif' => 'Aktif',
                    'nonaktif' => 'Nonaktif',
                ])
                ->default('aktif'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover')
                    ->label('Cover')
                    ->square(),

                TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('slug')
                    ->label('Slug')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('unit_pelaksana')
                    ->label('Unit'),

                ...\App\Filament\Support\OpdFields::tableColumns(),

                TextColumn::make('kontak')
                    ->label('Kontak'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn(string $state) => ucfirst($state)),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                ...\App\Filament\Support\OpdFields::filters(),

                SelectFilter::make('unit_pelaksana')
                    ->label('Filter Unit Pelaksana')
                    ->options(
                        InformasiLayanan::query()
                            ->distinct()
                            ->pluck('unit_pelaksana', 'unit_pelaksana')
                    )
                    ->searchable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                        ->after(function ($record) {
                            // Hapus file cover dari storage jika ada
                            if ($record->cover && Storage::disk('public')->exists($record->cover)) {
                                Storage::disk('public')->delete($record->cover);
                            }
                        }),
                ])
                    ->icon('heroicon-m-pencil-square')
                    ->color('danger')
                    ->tooltip('Aksi')
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->after(function ($records) {
                        // Hapus file cover untuk setiap record yang dihapus massal
                        foreach ($records as $record) {
                            if ($record->cover && Storage::disk('public')->exists($record->cover)) {
                                Storage::disk('public')->delete($record->cover);
                            }
                        }
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInformasiLayanans::route('/'),
            'create' => Pages\CreateInformasiLayanan::route('/create'),
            'edit' => Pages\EditInformasiLayanan::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return \App\Filament\Support\OpdFields::applyOpdScope(parent::getEloquentQuery());
    }

}
