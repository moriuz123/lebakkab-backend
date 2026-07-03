<?php

namespace App\Filament\Resources;

use App\Models\HeroSlider;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Filament\Resources\HeroSliderResource\Pages;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Actions\ActionGroup;      // ✅ Diperbaiki: import ActionGroup
use Filament\Tables\Actions\ViewAction;       // ✅ Diperbaiki: import ViewAction
use Filament\Tables\Actions\EditAction;       // ✅ Diperbaiki: import EditAction
use Filament\Tables\Actions\DeleteAction;     // ✅ Diperbaiki: import DeleteAction
use Illuminate\Support\Facades\Storage; // ✅ Tambahan penting

class HeroSliderResource extends Resource
{
    protected static ?string $model = HeroSlider::class;

    protected static ?string $navigationIcon = 'heroicon-c-arrow-right-circle';
    protected static ?string $navigationGroup = 'Manajemen Situs';
    protected static ?string $navigationLabel = 'Hero Slider';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('judul')
                ->required()
                ->maxLength(255),

            Textarea::make('deskripsi')
                ->rows(3)
                ->maxLength(500)
                ->placeholder('Teks deskripsi slider (opsional)'),

            FileUpload::make('gambar')
                ->image()
                ->imagePreviewHeight('150') // ✅ Optimasi preview image
                ->directory('hero-sliders')
                ->required(),

            Toggle::make('aktif')->label('Tampilkan'),

            Select::make('status')
                ->options([
                    1 => 'Aktif',
                    0 => 'Tidak Aktif',
                ])
                ->default(1),

            TextInput::make('order')
                ->numeric()
                ->default(0),
            ...\App\Filament\Support\OpdFields::form(false),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('gambar')
                    ->height(75)
                    ->width(100)
                    ->square(),

                TextColumn::make('judul')
                    ->sortable()
                    ->searchable()
                    ->limit(30), // ✅ Batasi panjang agar tabel lebih ringan

                TextColumn::make('deskripsi')
                    ->limit(40)
                    ->wrap(), // ✅ Agar teks panjang dibungkus ke bawah

                ToggleColumn::make('aktif')->label('Tampil'),

                TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn($state) => $state == 1 ? 'Aktif' : 'Tidak Aktif')
                    ->color(fn($state) => $state == 1 ? 'success' : 'danger'),

                TextColumn::make('order')->sortable(),
                ...\App\Filament\Support\OpdFields::tableColumns(),
            ])
            ->defaultSort('order')
            ->filters([
                ...\App\Filament\Support\OpdFields::filters(),
            ])
            ->paginationPageOptions([10, 25, 50]) // ✅ Optimasi jumlah data per halaman
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                        // ✅ Tambahan: hapus file gambar setelah delete
                        ->after(function ($record) {
                            if ($record->gambar && Storage::disk('public')->exists($record->gambar)) {
                                Storage::disk('public')->delete($record->gambar);
                            }
                        }),
                ])
                    ->icon('heroicon-m-pencil-square')
                    ->color('danger')
                    ->tooltip('Aksi'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHeroSliders::route('/'),
            'create' => Pages\CreateHeroSlider::route('/create'),
            'edit' => Pages\EditHeroSlider::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return \App\Filament\Support\OpdFields::applyOpdScope(parent::getEloquentQuery());
    }
}
