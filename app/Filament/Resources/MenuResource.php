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
                            Menu::TYPE_MAIN => 'Menu Utama',
                            Menu::TYPE_FRONT => 'Hero Menu',
                            Menu::TYPE_FOOTER_1 => 'Footer Widget 1',
                            Menu::TYPE_FOOTER_2 => 'Footer Widget 2',
                        ])
                        ->required(),

                    Forms\Components\Select::make('parent_id')
                        ->label('Menu Induk')
                        ->options(function (?Menu $record) {
                            $query = \App\Filament\Support\OpdFields::applyOpdScope(Menu::query());
                            if ($record) {
                                $query->where('id', '!=', $record->id);
                            }
                            return $query->pluck('title', 'id');
                        })
                        ->searchable()
                        ->nullable()
                        ->helperText('Kosongkan jika ini adalah Menu Utama. Jika dipilih, menu ini akan menjadi Sub-menu di bawahnya.')
                        ->rules([
                            fn (Forms\Get $get, ?Menu $record) => function (string $attribute, $value, \Closure $fail) use ($record) {
                                if ($value) {
                                    $parent = Menu::find($value);
                                    if ($parent && $parent->parent_id) {
                                        $fail('Struktur maksimal 2 level. Parent yang Anda pilih sudah merupakan sebuah Sub-menu.');
                                    }
                                    if ($record && $record->children()->exists()) {
                                        $fail('Menu ini sudah memiliki sub-menu di bawahnya. Anda tidak bisa memindahkannya menjadi sub-menu dari menu lain.');
                                    }
                                }
                            },
                        ]),

                    Forms\Components\Select::make('link_type')
                        ->label('Tipe Link')
                        ->options([
                            Menu::LINK_HOME => 'Beranda',
                            Menu::LINK_HALAMAN_STATIS => 'Halaman Statis',
                            Menu::LINK_KATEGORI_BERITA => 'Kategori Berita',
                            Menu::LINK_KATEGORI_DOKUMEN => 'Kategori Dokumen',
                            Menu::LINK_KATEGORI_BANNER => 'Kategori Banner',
                            Menu::LINK_MODUL => 'Modul',
                            Menu::LINK_PEJABAT => 'Detail Pejabat',
                            Menu::LINK_EKSTERNAL => 'Eksternal',
                            Menu::LINK_PARENT => 'Menu Induk (tanpa link)',
                        ])
                        ->reactive()
                        ->nullable()
                        ->helperText('Pilih "Menu Induk (tanpa link)" jika menu ini hanya berfungsi sebagai wadah dropdown (teks tidak bisa diklik).'),

                    Forms\Components\Select::make('link_ref')
                        ->label('Referensi Link')
                        ->options(function (callable $get) {
                            switch ($get('link_type')) {
                                case Menu::LINK_HALAMAN_STATIS:
                                    return \App\Filament\Support\OpdFields::applyOpdScope(\App\Models\HalamanStatis::query())->pluck('judul', 'slug');
                                case Menu::LINK_KATEGORI_BERITA:
                                    return \App\Models\Kategori::pluck('nama', 'slug');
                                case Menu::LINK_MODUL:
                                    return collect([
                                        'profil-daerah' => 'Profil Kabupaten',
                                        'profil-opd' => 'Profil OPD',
                                        'pejabat' => 'Data Pejabat',
                                        'aplikasi' => 'Data Aplikasi',
                                        'kategori_fotos' => 'Kategori Foto',
                                        'kategori_vidios' => 'Kategori Video',
                                        'kecamatans' => 'Kecamatan',
                                        'pengumuman' => 'Pengumuman',
                                        'agenda' => 'Agenda Pemerintahan',
                                        'opd' => 'OPD',
                                        'layanan' => 'Info Layanan',
                                        'berita' => 'Semua Berita',
                                        'dokumen' => 'Semua Dokumen',
                                        'kecamatan' => 'Data Kecamatan',
                                        'spon-tte' => 'Modul SPON TTE',
                                    ]);
                                case Menu::LINK_KATEGORI_DOKUMEN: // 🔹 ambil langsung dari tabel kategori_dokumens
                                    return \App\Models\KategoriDokumen::pluck('nama', 'slug');
                                case Menu::LINK_KATEGORI_BANNER:
                                    return \App\Models\KategoriBanner::pluck('nama', 'slug');
                                case Menu::LINK_PEJABAT:
                                    return \App\Filament\Support\OpdFields::applyOpdScope(\App\Models\Pejabat::query())->pluck('nama', 'id');
                                default:
                                    return [];
                            }
                        })
                        ->nullable()
                        ->hidden(fn($get) => in_array($get('link_type'), [Menu::LINK_EKSTERNAL, Menu::LINK_PARENT, null])),



                    Forms\Components\TextInput::make('icon')
                        ->label('Class Icon')
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
                        ->hidden(fn($get) => $get('link_type') !== Menu::LINK_EKSTERNAL),

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
                    ->label('Judul Menu')
                    ->searchable()
                    ->sortable()
                    ->weight(fn (Menu $record) => $record->parent_id ? 'regular' : 'bold')
                    ->color(fn (Menu $record) => $record->parent_id ? 'gray' : 'primary')
                    ->description(function (Menu $record): string {
                        // Ambil nama Tipe Menu
                        $typeLabel = match($record->menu_type) {
                            Menu::TYPE_MAIN => 'Menu Utama',
                            Menu::TYPE_FRONT => 'Hero Menu',
                            Menu::TYPE_FOOTER_1 => 'Footer Widget 1',
                            Menu::TYPE_FOOTER_2 => 'Footer Widget 2',
                            default => $record->menu_type,
                        };

                        // 1 Bintang: Menu Induk (tanpa parent)
                        if (is_null($record->parent_id)) {
                            return "⭐ {$typeLabel} - Menu Induk";
                        }
                        
                        // 2 Bintang: Sub Menu (parent-nya adalah Menu Induk)
                        if ($record->parent && is_null($record->parent->parent_id)) {
                            return "⭐⭐ {$typeLabel} - Sub Menu dari: " . $record->parent->title;
                        }

                        // 3 Bintang: Sub Sub Menu (parent-nya memiliki parent lagi)
                        return "⭐⭐⭐ {$typeLabel} - Sub Sub Menu dari: " . optional($record->parent)->title;
                    }),

                Tables\Columns\TextColumn::make('menu_type')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        Menu::TYPE_MAIN => 'Menu Utama',
                        Menu::TYPE_FRONT => 'Hero Menu',
                        Menu::TYPE_FOOTER_1 => 'Footer Widget 1',
                        Menu::TYPE_FOOTER_2 => 'Footer Widget 2',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('link_type')
                    ->badge(),

                Tables\Columns\TextColumn::make('parent.title')
                    ->label('Menu Induk')
                    ->toggleable(isToggledHiddenByDefault: true), // 🔹 Disembunyikan karena sudah ada di deskripsi title

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->sortable(),
                ...\App\Filament\Support\OpdFields::tableColumns(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order')
            ->filters([
                // 🔹 Filter berdasarkan tipe menu
                Tables\Filters\SelectFilter::make('menu_type')
                    ->label('Tipe Menu')
                    ->options([
                        Menu::TYPE_MAIN => 'Menu Utama',
                        Menu::TYPE_FRONT => 'Hero Menu',
                        Menu::TYPE_FOOTER_1 => 'Footer Widget 1',
                        Menu::TYPE_FOOTER_2 => 'Footer Widget 2',
                    ]),

                // 🔹 Filter berdasarkan parent
                Tables\Filters\SelectFilter::make('parent_id')
                    ->label('Menu Induk')
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

                // 🔹 Filter OPD Kustom (Menggantikan OpdFields::filters())
                Tables\Filters\SelectFilter::make('opd_id')
                    ->label('Filter Data OPD')
                    ->options(fn () => \App\Models\Opd::pluck('nama', 'id')->toArray())
                    ->searchable()
                    ->query(function (\Illuminate\Database\Eloquent\Builder $query, array $data) {
                        if (auth()->check() && auth()->user()->hasRole('super_admin')) {
                            if (!empty($data['value'])) {
                                // Jika filter OPD dipilih, tampilkan menu milik OPD tersebut
                                $query->where('opd_id', $data['value']);
                            } else {
                                // Default Super Admin: Hanya tampilkan menu Web Utama (opd_id = null)
                                $query->whereNull('opd_id');
                            }
                        }
                    })
                    ->hidden(fn () => auth()->check() && !auth()->user()->hasRole('super_admin') && auth()->user()->opd_id),
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
