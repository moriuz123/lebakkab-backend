<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengumumanResource\Pages;
use App\Models\Pengumuman;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms\Components\RichEditor;






class PengumumanResource extends Resource
{
    protected static ?string $model = Pengumuman::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static ?string $navigationLabel = 'Pengumuman';
    protected static ?string $modelLabel = 'Pengumuman';
    protected static ?string $navigationGroup = 'Kelola Konten';



    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('judul')
                ->label('Judul Pengumuman')
                ->required()
                ->live(debounce: 500),

            TextInput::make('slug')
                ->helperText('(Salin saja dari judul)')
                ->label('Slug')
                ->required()
                ->maxLength(255)
                ->live()
                ->afterStateUpdated(function (\Filament\Forms\Set $set, $state) {
                    $slug = str($state)->slug()->toString();
                    $set('slug', $slug);
                }),

            ...\App\Filament\Support\OpdFields::form(),

            RichEditor::make('isi')
                ->label('Isi Pengumuman')
                ->required()
                ->columnSpanFull(),

            FileUpload::make('gambar')
                ->image()
                ->directory('pengumuman-gambar')
                ->label('Gambar'),

            FileUpload::make('file_lampiran')
                ->hint('(Bisa di Kosongkan Jika tidak ada.)')
                ->label('File Lampiran')
                ->disk('public')
                ->directory('pengumuman')
                ->visibility('public'),

            DatePicker::make('tgl_pelaksanaan')
                ->label('Tanggal Pelaksanaan')
                ->required(),



            DatePicker::make('mulai_tayang')
                ->label('Mulai Tayang')
                ->required(),

            DatePicker::make('selesai_tayang')
                ->label('Selesai Tayang')
                ->required(),

            Toggle::make('status')
                ->label('Tampilkan?')
                ->default(true),
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->wrap()
                    ->label('Judul'),

                Tables\Columns\ImageColumn::make('gambar')
                    ->label('Gambar')
                    ->size(50),

                TextColumn::make('mulai_tayang')
                    ->date('d M Y')
                    ->sortable()
                    ->label('Mulai Tayang'),

                TextColumn::make('selesai_tayang')
                    ->date('d M Y')
                    ->sortable()
                    ->label('Selesai Tayang'),

                TextColumn::make('tgl_pelaksanaan')
                    ->label('Tanggal Pelaksanaan')
                    ->date('d M Y')
                    ->sortable(),

                ...\App\Filament\Support\OpdFields::tableColumns(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn(bool $state) => $state ? 'Tampil' : 'Tidak Tampil')
                    ->color(fn(bool $state) => $state ? 'success' : 'gray'),

                TextColumn::make('file_lampiran')
                    ->label('Lampiran')
                    ->url(fn($record) => $record->file_lampiran ? asset('storage/' . $record->file_lampiran) : null)
                    ->openUrlInNewTab()
                    ->icon('heroicon-m-arrow-down-tray')
                    ->tooltip('Unduh File'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                ...\App\Filament\Support\OpdFields::filters(),
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
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengumumen::route('/'),
            'create' => Pages\CreatePengumuman::route('/create'),
            'edit' => Pages\EditPengumuman::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return \App\Filament\Support\OpdFields::applyOpdScope(parent::getEloquentQuery());
    }

}
