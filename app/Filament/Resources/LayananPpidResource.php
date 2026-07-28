<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LayananPpidResource\Pages;
use App\Models\LayananPpid;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LayananPpidResource extends Resource
{
    protected static ?string $model = LayananPpid::class;
    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';
    protected static ?string $navigationGroup = 'Layanan PPID';
    protected static ?string $navigationLabel = 'Layanan PPID';
    protected static ?string $pluralLabel = 'Layanan PPID';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Layanan PPID')->schema([
                    Forms\Components\TextInput::make('nama_layanan')
                        ->required()
                        ->label('Nama Layanan'),

                    Forms\Components\Textarea::make('deskripsi_layanan')
                        ->label('Deskripsi Layanan')
                        ->rows(3),

                    Forms\Components\TextInput::make('icon')
                        ->label('Class Icon')
                        ->placeholder('contoh: calendar_month, campaign, inventory_2')
                        ->helperText('Gunakan nama icon dari Google Material Symbols (contoh: calendar_month)'),

                    Forms\Components\Select::make('sumber_link_type')
                        ->label('Sumber Link CTA')
                        ->options([
                            LayananPpid::TYPE_HALAMAN_STATIS => 'Halaman Statis',
                            LayananPpid::TYPE_KATEGORI_DOKUMEN => 'Kategori Dokumen',
                            LayananPpid::TYPE_SUB_KATEGORI_DOKUMEN => 'Sub Kategori Dokumen',
                            LayananPpid::TYPE_LINK_EKSTERNAL => 'Link Eksternal (New Tab)',
                        ])
                        ->reactive()
                        ->nullable(),

                    Forms\Components\Select::make('link_ref')
                        ->label('Pilih / Masukkan Link')
                        ->options(function (callable $get) {
                            switch ($get('sumber_link_type')) {
                                case LayananPpid::TYPE_HALAMAN_STATIS:
                                    return \App\Filament\Support\OpdFields::applyOpdScope(\App\Models\HalamanStatis::query())->pluck('judul', 'slug');
                                case LayananPpid::TYPE_KATEGORI_DOKUMEN:
                                    return \App\Models\KategoriDokumen::whereNull('parent_id')->pluck('nama', 'slug');
                                case LayananPpid::TYPE_SUB_KATEGORI_DOKUMEN:
                                    return \App\Models\KategoriDokumen::whereNotNull('parent_id')->pluck('nama', 'slug');
                                default:
                                    return [];
                            }
                        })
                        ->nullable()
                        ->hidden(fn($get) => in_array($get('sumber_link_type'), [LayananPpid::TYPE_LINK_EKSTERNAL, null])),

                    Forms\Components\TextInput::make('link_ref_external')
                        ->label('URL Eksternal')
                        ->url()
                        ->hidden(fn($get) => $get('sumber_link_type') !== LayananPpid::TYPE_LINK_EKSTERNAL)
                        ->afterStateHydrated(function (Forms\Components\TextInput $component, $state, $record) {
                            if ($record && $record->sumber_link_type === LayananPpid::TYPE_LINK_EKSTERNAL) {
                                $component->state($record->link_ref);
                            }
                        })
                        ->dehydrated(false)
                        ->reactive(),

                    Forms\Components\TextInput::make('sort_order')
                        ->label('Urutan')
                        ->numeric()
                        ->default(0),

                    ...\App\Filament\Support\OpdFields::form(false),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('icon')
                    ->label('Icon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_layanan')
                    ->label('Nama Layanan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sumber_link_type')
                    ->label('Tipe Link')
                    ->badge(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
                ...\App\Filament\Support\OpdFields::tableColumns(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order')
            ->filters([
                ...\App\Filament\Support\OpdFields::filters(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLayananPpids::route('/'),
            'create' => Pages\CreateLayananPpid::route('/create'),
            'edit' => Pages\EditLayananPpid::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return \App\Filament\Support\OpdFields::applyOpdScope(parent::getEloquentQuery());
    }
}
