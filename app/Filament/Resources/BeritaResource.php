<?php

namespace App\Filament\Resources;

use App\Models\Berita;
use Filament\Tables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\ActionGroup; // 🔹 DITAMBAHKAN
use App\Filament\Resources\BeritaResource\Pages;

class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Berita';
    protected static ?string $pluralModelLabel = 'Berita';
    protected static ?string $slug = 'beritas';
    protected static ?string $navigationGroup = 'Data Berita';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('judul')
                ->label('Judul')
                ->required()
                ->maxLength(255),

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

            Select::make('status')
                ->label('Status')
                ->options([
                    'draft' => 'Draft',
                    'published' => 'Published',
                ])
                ->default('draft')
                ->required(),

            Select::make('kategori_id')
                ->label('Kategori')
                ->relationship('kategori', 'nama', fn (\Illuminate\Database\Eloquent\Builder $query) => \App\Filament\Support\OpdFields::applyOpdScope($query))
                ->searchable()
                ->preload()
                ->required(),

            Select::make('tags')
                ->multiple()
                ->relationship('tags', 'nama', fn (\Illuminate\Database\Eloquent\Builder $query) => \App\Filament\Support\OpdFields::applyOpdScope($query))
                ->searchable()
                ->preload()
                ->columnSpanFull(),

            FileUpload::make('thumbnail')
                ->label('Thumbnail')
                ->image()
                ->disk('public')
                ->directory('berita/thumbnails')
                ->required(),

            RichEditor::make('konten')
                ->label('Konten Berita')
                ->required()
                ->columnSpanFull(),

            DatePicker::make('tanggal_publish')
                ->label('Tanggal Publish')
                ->required()
                ->default(now())
                ->helperText('Tanggal ini yang akan ditampilkan di frontend sebagai tanggal berita.'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Gambar')
                    ->disk('public')
                    ->height(60)
                    ->width(80),

                TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->extraAttributes(['class' => 'whitespace-normal break-words'])
                    ->limit(50),

                Tables\Columns\TextColumn::make('views')
                    ->label('Dilihat')
                    ->sortable(),

                TextColumn::make('penulis')
                    ->label('Penulis')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('slug')
                    ->label('Slug')
                    ->extraAttributes(['class' => 'whitespace-normal break-words'])
                    ->limit(50),

                TextColumn::make('kategori.nama')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),

                ...\App\Filament\Support\OpdFields::tableColumns(),

                TextColumn::make('tags.nama')
                    ->label('Tags')
                    ->badge()
                    ->separator(','),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                        default => 'secondary',
                    })
                    ->sortable(),

                TextColumn::make('tanggal_publish')
                    ->label('Tanggal Publish')
                    ->dateTime('d M Y')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y'),

                TextColumn::make('deleted_at')
                    ->label('Dihapus')
                    ->dateTime('d M Y')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->relationship('kategori', 'nama', fn (\Illuminate\Database\Eloquent\Builder $query) => \App\Filament\Support\OpdFields::applyOpdScope($query))
                    ->label('Filter Kategori'),

                ...\App\Filament\Support\OpdFields::filters(),

                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ]),

                TrashedFilter::make(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                // 🔹 DITAMBAHKAN: semua tombol dibungkus ke dalam ActionGroup agar rapi
                ActionGroup::make([
                    Tables\Actions\Action::make('view_page') // 🔹 tombol custom
                        ->label('Lihat Halaman')
                        ->icon('heroicon-o-eye')
                        // ->url(fn($record) => url('/berita/' . $record->slug)) // 🔹 arahkan ke frontend sementara di ganti oleh:
                        ->url(fn($record) => url('http://localhost:5173/berita/' . $record->slug)) // 🔹 arahkan ke frontend
                        ->openUrlInNewTab(), // 🔹 buka tab baru
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                        ->after(function ($record) {
                            if ($record->thumbnail && Storage::disk('public')->exists($record->thumbnail)) {
                                Storage::disk('public')->delete($record->thumbnail);
                            }
                        }),
                    RestoreAction::make(),
                    ForceDeleteAction::make()
                        ->after(function ($record) {
                            if ($record->thumbnail && Storage::disk('public')->exists($record->thumbnail)) {
                                Storage::disk('public')->delete($record->thumbnail);
                            }
                        }),
                ])
                    ->icon('heroicon-o-pencil-square')
                    ->color('danger')
                    ->tooltip('Aksi')
            ])



            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'edit' => Pages\EditBerita::route('/{record}/edit'),
            'trashed' => Pages\ListBeritas::route('/trashed'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return \App\Filament\Support\OpdFields::applyOpdScope(
            parent::getEloquentQuery()
                ->with(['kategori', 'tags'])
                ->withTrashed()
        );
    }
}
