<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PolingResource\Pages;
use App\Models\Poling;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;

class PolingResource extends Resource
{
    protected static ?string $model = Poling::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'Poling';
    protected static ?string $navigationGroup = 'Interaksi';
    protected static ?int $navigationSort = 3;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('pilihan')
                    ->label('Isi')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('type')
                    ->label('Tipe')
                    ->options([
                        'Pertanyaan' => 'Pertanyaan',
                        'Jawaban' => 'Jawaban',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('rating')
                    ->label('Rating')
                    ->numeric()
                    ->default(0),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        1 => 'Aktif',
                        0 => 'Nonaktif',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('polling_id')
                    ->label('ID Pertanyaan')
                    ->numeric()
                    ->helperText('Kosongkan jika ini adalah pertanyaan'),
                ...\App\Filament\Support\OpdFields::form(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),

                TextColumn::make('pilihan')
                    ->label('Isi')
                    ->wrap()
                    ->searchable(),

                TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn(string $state): string => $state === 'Pertanyaan' ? 'primary' : 'gray'),

                TextColumn::make('polling_id')
                    ->label('ID Pertanyaan')
                    ->sortable()
                    ->hidden(fn($record) => $record && $record->type === 'Pertanyaan'),
                ...\App\Filament\Support\OpdFields::tableColumns(),

                TextColumn::make('rating')
                    ->label('Jumlah Vote')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn($state) => $state == 1 ? 'Aktif' : 'Nonaktif')
                    ->color(fn($state) => $state == 1 ? 'success' : 'danger'),

                TextColumn::make('created_at')->label('Dibuat')->dateTime()->since(),
            ])
            ->defaultSort('id', 'asc')
            ->filters([
                ...\App\Filament\Support\OpdFields::filters(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPolings::route('/'),
            'create' => Pages\CreatePoling::route('/create'),
            'edit' => Pages\EditPoling::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return \App\Filament\Support\OpdFields::applyOpdScope(parent::getEloquentQuery());
    }
}
