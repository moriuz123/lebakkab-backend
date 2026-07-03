<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgendaResource\Pages;
use App\Models\Agenda;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Group;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions;

class AgendaResource extends Resource
{
    protected static ?string $model = Agenda::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Kelola Konten';
    protected static ?string $navigationLabel = 'Agenda';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('judul')->required(),
            ...\App\Filament\Support\OpdFields::form(),
            TextInput::make('lokasi')->required(),
            TextInput::make('dresscode'),
            Textarea::make('deskripsi')->rows(3),

            DatePicker::make('tanggal_mulai')->required(),
            DatePicker::make('tanggal_selesai')->required(),
            TimePicker::make('waktu_mulai')->required(),

            Select::make('opsi_waktu_selesai')
                ->label('Opsi Waktu Selesai')
                ->options([
                    'tentukan' => 'Tentukan waktu',
                    'selesai' => 'Waktu tdk ditentukan',
                ])
                ->default('tentukan')
                ->reactive(), // ✅ Agar kondisi visible bisa berubah dinamis

            Group::make([
                TimePicker::make('waktu_selesai')
                    ->label('Waktu Selesai')
                    ->visible(fn($get) => $get('opsi_waktu_selesai') === 'tentukan')
                    ->nullable(),

                TextInput::make('waktu_selesai_text')
                    ->label('Waktu Selesai')
                    ->default('s.d selesai')
                    ->visible(fn($get) => $get('opsi_waktu_selesai') === 'selesai')
                    ->disabled(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')
                    ->sortable()
                    ->searchable(),

                ...\App\Filament\Support\OpdFields::tableColumns(),

                TextColumn::make('lokasi')
                    ->limit(30),

                TextColumn::make('tanggal_mulai')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('tanggal_selesai')
                    ->date('d M Y'),

                TextColumn::make('waktu_mulai')
                    ->label('Waktu Mulai')
                    ->formatStateUsing(fn($state) => \Carbon\Carbon::parse($state)->format('H:i')),

                TextColumn::make('waktu_selesai')
                    ->label('Waktu Selesai')
                    ->formatStateUsing(function ($record) {
                        return $record->opsi_waktu_selesai === 'selesai'
                            ? 's.d selesai'
                            : ($record->waktu_selesai
                                ? \Carbon\Carbon::parse($record->waktu_selesai)->format('H:i')
                                : '-');
                    }),
            ])
            ->defaultSort('tanggal_mulai', 'desc') // ✅ Hapus titik koma di sini
            ->filters([
                ...\App\Filament\Support\OpdFields::filters(),
            ])
            ->actions([ // ✅ Ini sebelumnya tidak dieksekusi karena titik koma di atas
                Actions\ActionGroup::make([
                    Actions\ViewAction::make(),
                    Actions\EditAction::make(),
                    Actions\DeleteAction::make(),
                ])
                    ->icon('heroicon-o-pencil-square')
                    ->color('danger')
                    ->tooltip('Aksi'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgendas::route('/'),
            'create' => Pages\CreateAgenda::route('/create'),
            'edit' => Pages\EditAgenda::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return \App\Filament\Support\OpdFields::applyOpdScope(parent::getEloquentQuery());
    }

}
