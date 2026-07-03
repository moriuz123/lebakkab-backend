<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Models\Menu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;
    protected static ?string $navigationIcon = 'heroicon-o-bars-3';
    protected static ?string $navigationGroup = 'Manajemen Situs';
    protected static ?string $navigationLabel = 'Kelola Menu';
    protected static ?string $pluralLabel = 'Kelola Menu';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Menu Info')->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->label('Judul Menu'),

                    Forms\Components\Select::make('menu_type')
                        ->options([
                            'main' => 'Main Menu',
                            'front' => 'Front Menu',
                            'footer' => 'Footer Menu',
                        ])
                        ->required(),

                    Forms\Components\Select::make('parent_id')
                        ->label('Parent Menu')
                        ->options(\App\Filament\Support\OpdFields::applyOpdScope(Menu::query())->pluck('title', 'id'))
                        ->searchable()
                        ->nullable(),

                    Forms\Components\Select::make('link_type')
                        ->label('Tipe Link')
                        ->options([
                            'home' => 'Beranda',
                            'halaman_statis' => 'Halaman Statis',
                            'kategori_berita' => 'Kategori Berita',
                            'kategori_dokumen' => 'Kategori Dokumen', // 🔹 tambahkan ini
                            'modul' => 'Modul',
                            'eksternal' => 'Eksternal',
                            'parent' => 'Menu Induk (tanpa link)',
                        ])
                        ->reactive()
                        ->nullable(),

                    Forms\Components\Select::make('link_ref')
                        ->label('Referensi Link')
                        ->options(function (callable $get) {
                            switch ($get('link_type')) {
                                case 'halaman_statis':
                                    return \App\Filament\Support\OpdFields::applyOpdScope(\App\Models\HalamanStatis::query())->pluck('judul', 'id');
                                case 'kategori_berita':
                                    return \App\Models\Kategori::pluck('nama', 'slug');
                                case 'modul':
                                    return collect([
                                        'aplikasi' => 'Data Aplikasi',
                                        'kategori_fotos' => 'Kategori Foto',
                                        'kategori_vidios' => 'Kategori Video',
                                        'kecamatans' => 'Kecamatan',
                                        'pengumuman' => 'Pengumuman',
                                        'agenda' => 'Agenda Pemerintahan',
                                        'opd' => 'OPD',
                                        'layanan' => 'Info Layanan',
                                        'berita' => 'Semua Berita',
                                        'kecamatan' => 'Data Kecamatan',
                                    ]);
                                case 'kategori_dokumen': // 🔹 ambil langsung dari tabel kategori_dokumens
                                    return \App\Models\KategoriDokumen::pluck('nama', 'slug');
                                default:
                                    return [];
                            }
                        })
                        ->nullable()
                        ->hidden(fn($get) => in_array($get('link_type'), ['eksternal', 'parent', null])),



                    Forms\Components\TextInput::make('icon')
                        ->label('Icon Class')
                        ->placeholder('contoh: heroicon-o-home atau lucide-user')
                        ->hintAction(
                            Forms\Components\Actions\Action::make('lihatIcon')
                                ->label('Lihat Contoh Icon')
                                ->modalHeading('Contoh Class Icon (Heroicons & Lucide)')
                                ->modalSubmitAction(false)
                                ->modalCancelActionLabel('Tutup')
                                ->modalContent(view('filament.icons-example')) // pakai blade custom
                        ),

                    Forms\Components\TextInput::make('url')
                        ->label('URL Eksternal')
                        ->url()
                        ->hidden(fn($get) => $get('link_type') !== 'eksternal'),

                    Forms\Components\TextInput::make('sort_order')
                        ->numeric()
                        ->default(0),

                    Forms\Components\Toggle::make('is_active')->default(true),
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
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('menu_type')
                    ->badge(),

                Tables\Columns\TextColumn::make('link_type')
                    ->badge(),

                Tables\Columns\TextColumn::make('parent.title')
                    ->label('Parent'),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->sortable(),
                ...\App\Filament\Support\OpdFields::tableColumns(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([
                // 🔹 Filter berdasarkan tipe menu
                Tables\Filters\SelectFilter::make('menu_type')
                    ->label('Tipe Menu')
                    ->options([
                        'main' => 'Main Menu',
                        'front' => 'Front Menu',
                        'footer' => 'Footer Menu',
                    ]),

                // 🔹 Filter berdasarkan parent
                Tables\Filters\SelectFilter::make('parent_id')
                    ->label('Parent Menu')
                    ->options(\App\Filament\Support\OpdFields::applyOpdScope(Menu::whereNull('parent_id'))->pluck('title', 'id'))
                    ->placeholder('Semua'),

                // 🔹 Filter untuk menu induk saja (tanpa parent)
                Tables\Filters\TernaryFilter::make('is_parent')
                    ->label('Menu Induk / Single')
                    ->placeholder('Semua')
                    ->trueLabel('Hanya Menu Induk')
                    ->falseLabel('Hanya Submenu')
                    ->queries(
                        true: fn($query) => $query->whereNull('parent_id'),
                        false: fn($query) => $query->whereNotNull('parent_id'),
                    ),
                ...\App\Filament\Support\OpdFields::filters(),
            ])

            // test
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),

                ])
                    ->icon('heroicon-m-pencil-square')
                    ->color('danger')
                    ->tooltip('Aksi')
            ]);
        // test action end
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return \App\Filament\Support\OpdFields::applyOpdScope(parent::getEloquentQuery());
    }
}
