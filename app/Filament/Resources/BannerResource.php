<?php

namespace App\Filament\Resources;

use App\Models\Banner;

use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use App\Filament\Resources\BannerResource\Pages;
use Filament\Notifications\Notification;


class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Banner';
    protected static ?string $pluralModelLabel = 'Banner';
    protected static ?string $slug = 'banner';
    protected static ?string $navigationGroup = 'Kelola Konten';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('judul')
                ->label('Judul')
                ->required()
                ->maxLength(200),

            TextInput::make('slug')
                ->label('Slug')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(function (\Filament\Forms\Set $set, $state) {
                    $slug = str($state)->slug()->toString();
                    $set('slug', $slug);
                }),

            ...\App\Filament\Support\OpdFields::form(),

            Select::make('kategori')
                ->label('Kategori')
                ->options([
                    'ucapan' => 'Ucapan',
                    'infografis' => 'Infografis',
                ])
                ->required(),

            FileUpload::make('gambar')
                ->label('Gambar')
                ->image()
                ->directory('banner')
                ->preserveFilenames()
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('gambar')
                    ->label('Gambar')
                    ->disk('public')
                    ->width(80)
                    ->height(60),

                TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable(),

                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable(),

                TextColumn::make('kategori')
                    ->label('Kategori'),

                ...\App\Filament\Support\OpdFields::tableColumns(),
            ])
            ->filters([
                ...\App\Filament\Support\OpdFields::filters(),

                Tables\Filters\SelectFilter::make('kategori')
                    ->label('Kategori')
                    ->options([
                        'ucapan' => 'Ucapan',
                        'infografis' => 'Infografis',
                    ])
            ])

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
                Tables\Actions\DeleteBulkAction::make()
                    ->label('🗑️ Hapus Terpilih')
                    ->color('danger')
                    ->icon('heroicon-o-trash')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Penghapusan')
                    ->modalDescription('Apakah Anda yakin ingin menghapus semua banner yang dipilih?')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->successNotificationTitle('Berhasil menghapus data yang dipilih')
                    ->failureNotification(
                        Notification::make()
                            ->title('Gagal menghapus data')
                            ->body('Terjadi kesalahan saat menghapus. Silakan coba lagi.')
                            ->danger()
                    ),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return \App\Filament\Support\OpdFields::applyOpdScope(parent::getEloquentQuery());
    }

}
