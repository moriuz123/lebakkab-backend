<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KritikSaranResource\Pages;
use App\Models\KritikSaran;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Filament\Resources\Resource;

class KritikSaranResource extends Resource
{
    protected static ?string $model = KritikSaran::class;

    protected static ?string $navigationIcon = 'heroicon-s-chat-bubble-left-ellipsis';
    protected static ?string $navigationLabel = 'Kritik & Saran';
    protected static ?string $navigationGroup = 'Interaksi';

    public static function form(Form $form): Form
    {
        return $form->schema(static::getFormSchema());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(static::getTableColumns())
            ->defaultSort('tanggal', 'desc')
            ->filters([
                ...\App\Filament\Support\OpdFields::filters(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKritikSaran::route('/'),
            'create' => Pages\CreateKritikSaran::route('/create'),
            'edit' => Pages\EditKritikSaran::route('/{record}/edit'),
        ];
    }

    public static function getFormSchema(): array
    {
        return [
            TextInput::make('nama')
                ->required()
                ->maxLength(200),

            TextInput::make('email')
                ->email()
                ->maxLength(100),

            TextInput::make('no_hpusr')
                ->label('No. HP')
                ->maxLength(15),

            TextInput::make('judul')
                ->required()
                ->maxLength(200),

            Textarea::make('isi_kritik')
                ->label('Isi Kritik / Saran')
                ->rows(5)
                ->required(),

            DatePicker::make('tanggal')
                ->label('Tanggal')
                ->default(now()),

            Toggle::make('status')
                ->label('Tampilkan?'),

            Textarea::make('balas')
                ->label('Balasan')
                ->rows(4),
            ...\App\Filament\Support\OpdFields::form(),
        ];
    }

    public static function getTableColumns(): array
    {
        return [
            TextColumn::make('nama')->searchable(),
            TextColumn::make('email')->label('Email'),
            TextColumn::make('judul')->label('Judul')->limit(30),
            IconColumn::make('status')->label('Tampil')->boolean(),
            ...\App\Filament\Support\OpdFields::tableColumns(),
            TextColumn::make('tanggal')->label('Tanggal')->date('d M Y'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return \App\Filament\Support\OpdFields::applyOpdScope(parent::getEloquentQuery());
    }
}
