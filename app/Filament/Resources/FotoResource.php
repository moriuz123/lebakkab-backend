<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FotoResource\Pages;
use App\Models\Foto;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class FotoResource extends Resource
{
    protected static ?string $model = Foto::class;

    protected static ?string $navigationIcon = 'heroicon-o-camera';
    protected static ?string $navigationGroup = 'Galeri';
    protected static ?string $navigationLabel = 'Foto';

    public static function form(Form $form): Form
    {
        return $form->schema(static::getFormSchema());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(static::getTableColumns())
            ->filters(static::getTableFilters())
            ->actions([
                // ActionGroup disarankan untuk mengelompokkan aksi
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
                    ->icon('heroicon-m-pencil-square')
                    ->color('danger')
                    ->tooltip('Aksi')
            ]) // ← PERBAIKAN: Tambahkan penutup `])` agar tidak error
            ->defaultSort('created_at', 'desc'); // ← PERBAIKAN: Baris ini sempat masuk ke dalam blok `actions`, harusnya di luar
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFoto::route('/'),
            'create' => Pages\CreateFoto::route('/create'),
            'edit' => Pages\EditFoto::route('/{record}/edit'),
        ];
    }

    public static function getFormSchema(): array
    {
        return [
            TextInput::make('judul')
                ->label('Judul Foto')
                ->required(),

            ...\App\Filament\Support\OpdFields::form(),

            Select::make('kategori_foto_id')
                ->label('Kategori Foto')
                ->relationship('kategori', 'nama') // Pastikan relasi 'kategori' ada di model Foto
                ->searchable()
                ->preload()
                ->required(),

            FileUpload::make('gambar')
                ->label('Gambar')
                ->image()
                ->imageEditor() // Opsional
                ->required(),

            Textarea::make('deskripsi')
                ->label('Deskripsi')
                ->rows(4),
        ];
    }

    public static function getTableColumns(): array
    {
        return [
            ImageColumn::make('gambar')
                ->label('Foto')
                ->width(100)
                ->height(60),

            TextColumn::make('judul')
                ->label('Judul')
                ->searchable()
                ->limit(30),

            TextColumn::make('kategori.nama') // ← Pastikan relasi 'kategori' di model Foto mengarah ke KategoriFoto
                ->label('Kategori'),

            ...\App\Filament\Support\OpdFields::tableColumns(),

            TextColumn::make('created_at')
                ->label('Tanggal')
                ->dateTime('d M Y H:i'),
        ];
    }

    public static function getTableFilters(): array
    {
        return [
            ...\App\Filament\Support\OpdFields::filters(),

            SelectFilter::make('kategori_foto_id')
                ->label('Kategori')
                ->relationship('kategori', 'nama', fn (\Illuminate\Database\Eloquent\Builder $query) => \App\Filament\Support\OpdFields::applyOpdScope($query))
                ->searchable()
                ->preload(),

            Filter::make('created_at')
                ->label('Tanggal Upload')
                ->form([
                    DatePicker::make('from')->label('Dari'),
                    DatePicker::make('until')->label('Sampai'),
                ])
                ->query(function ($query, array $data) {
                    return $query
                        ->when($data['from'], fn($q) => $q->whereDate('created_at', '>=', $data['from']))
                        ->when($data['until'], fn($q) => $q->whereDate('created_at', '<=', $data['until']));
                }),
        ];
    }
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return \App\Filament\Support\OpdFields::applyOpdScope(parent::getEloquentQuery());
    }

}
