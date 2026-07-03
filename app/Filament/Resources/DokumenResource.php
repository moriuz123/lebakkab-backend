<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DokumenResource\Pages;

use App\Models\Dokumen;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables;






class DokumenResource extends Resource
{
    protected static ?string $model = Dokumen::class;

    protected static ?string $navigationGroup = 'Kelola Konten';
    protected static ?string $navigationLabel = 'Dokumen';
    protected static ?string $label = 'Dokumen';
    protected static ?string $navigationIcon = 'heroicon-o-document';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(1)->schema([
                TextInput::make('judul')
                    ->required()
                    ->label('Judul Dokumen'),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->live()
                    ->afterStateUpdated(function (?string $state, callable $set) {
                        $set('slug', Str::slug($state));
                    }),

                ...\App\Filament\Support\OpdFields::form(),

                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->rows(3),

                Forms\Components\Select::make('kategori_dokumen_id')
                    ->label('Kategori')
                    ->relationship('kategori', 'nama', fn (\Illuminate\Database\Eloquent\Builder $query) => \App\Filament\Support\OpdFields::applyOpdScope($query))
                    ->required(),

                Radio::make('sumber_type')
                    ->label('Sumber Dokumen')
                    ->options([
                        'upload' => 'Upload File',
                        'drive' => 'Link Google Drive',
                    ])
                    ->default('upload')
                    ->required()
                    ->reactive(),

                FileUpload::make('file_path')
                    ->label('File PDF')
                    ->disk('public')
                    ->directory('dokumens')
                    ->visibility('public')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(2048)
                    ->required(fn($get) => $get('sumber_type') === 'upload')
                    ->hidden(fn($get) => $get('sumber_type') !== 'upload'),

                TextInput::make('link_drive')
                    ->label('Link Google Drive')
                    ->url()
                    ->required(fn($get) => $get('sumber_type') === 'drive')
                    ->hidden(fn($get) => $get('sumber_type') !== 'drive'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            \Filament\Tables\Columns\TextColumn::make('judul')
                ->searchable()
                ->extraAttributes(['class' => 'whitespace-normal break-words']),

            \Filament\Tables\Columns\TextColumn::make('slug')
                ->label('Slug')
                ->toggleable(isToggledHiddenByDefault: true)
                ->extraAttributes(['class' => 'whitespace-normal break-words']),

            \Filament\Tables\Columns\TextColumn::make('kategori.nama')
                ->label('Kategori')
                ->searchable()
                ->sortable()
                ->extraAttributes(['class' => 'whitespace-normal break-words']),

            ...\App\Filament\Support\OpdFields::tableColumns(),

        ])
            ->filters([
                ...\App\Filament\Support\OpdFields::filters(),

                Tables\Filters\SelectFilter::make('kategori_dokumen_id')
                    ->label('Kategori')
                    ->relationship('kategori', 'nama', fn (\Illuminate\Database\Eloquent\Builder $query) => \App\Filament\Support\OpdFields::applyOpdScope($query))
                    ->searchable()
                    ->preload(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
                    ->icon('heroicon-m-pencil-square')
                    ->color('danger')
                    ->tooltip('Aksi')
            ])

            ->bulkActions([
                DeleteBulkAction::make(),
            ])
            ->striped();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDokumens::route('/'),
            'create' => Pages\CreateDokumen::route('/create'),
            'edit' => Pages\EditDokumen::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return \App\Filament\Support\OpdFields::applyOpdScope(parent::getEloquentQuery());
    }

}
