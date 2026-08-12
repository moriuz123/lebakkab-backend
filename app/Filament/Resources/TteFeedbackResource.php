<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TteFeedbackResource\Pages;
use App\Models\TteFeedback;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Card;

class TteFeedbackResource extends Resource
{
    protected static ?string $model = TteFeedback::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
    protected static ?string $navigationGroup = 'SPON TTE';
    protected static ?string $navigationLabel = 'Ulasan & Masukan';
    protected static ?string $pluralModelLabel = 'Ulasan & Masukan';
    protected static ?int $navigationSort = 3;

    public static function canViewAny(): bool
    {
        $user = auth()->user();
        if (!$user) return false;
        if ($user->hasRole('super_admin')) return true;
        return $user->opd && str_contains(strtolower($user->opd->nama), 'komunikasi');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Forms\Components\TextInput::make('nama')
                        ->label('Nama')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('instansi')
                        ->label('Instansi / OPD')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('rating')
                        ->label('Rating Umum (Lama)')
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(5),
                    Forms\Components\TextInput::make('rating_kemudahan')
                        ->label('Kemudahan Penggunaan (1-5)')
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(5),
                    Forms\Components\TextInput::make('rating_kecepatan')
                        ->label('Kecepatan Proses (1-5)')
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(5),
                    Forms\Components\TextInput::make('rating_kejelasan')
                        ->label('Kejelasan Informasi (1-5)')
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(5),
                    Forms\Components\TextInput::make('rating_pelayanan')
                        ->label('Kualitas Bantuan (1-5)')
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(5),
                    Forms\Components\Textarea::make('pesan')
                        ->label('Pesan / Kendala')
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\Toggle::make('is_read')
                        ->label('Telah Dibaca')
                        ->default(false),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Tanggal')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('instansi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rating_kemudahan')
                    ->label('Kemudahan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rating_kecepatan')
                    ->label('Kecepatan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rating_kejelasan')
                    ->label('Kejelasan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rating_pelayanan')
                    ->label('Pelayanan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_read')
                    ->boolean()
                    ->label('Dibaca'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_read')
                    ->label('Status Baca')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTteFeedback::route('/'),
            'create' => Pages\CreateTteFeedback::route('/create'),
            'edit' => Pages\EditTteFeedback::route('/{record}/edit'),
        ];
    }
}
