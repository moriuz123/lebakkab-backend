<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TteInfoResource\Pages;
use App\Models\TteInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Card;

class TteInfoResource extends Resource
{
    protected static ?string $model = TteInfo::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationGroup = 'SPON TTE';
    protected static ?string $navigationLabel = 'Info & Prosedur';
    protected static ?string $pluralModelLabel = 'Info & Prosedur TTE';
    protected static ?int $navigationSort = 2;

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
                    Forms\Components\Select::make('kategori')
                        ->options([
                            'tentang' => 'Tentang TTE',
                            'alur_prosedur' => 'Alur & Prosedur',
                            'syarat' => 'Persyaratan',
                            'tutorial' => 'Video Tutorial (Link)',
                        ])
                        ->required(),
                    Forms\Components\TextInput::make('judul')
                        ->label('Judul')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\RichEditor::make('konten')
                        ->label('Konten (Penjelasan / Link Video)')
                        ->columnSpanFull(),
                    Forms\Components\FileUpload::make('gambar')
                        ->label('Gambar / Ilustrasi')
                        ->disk('s3')
                        ->image()
                        ->directory('tte/info'),
                    Forms\Components\TextInput::make('urutan')
                        ->numeric()
                        ->default(0),
                ])->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('urutan')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('kategori')
                    ->colors([
                        'primary' => 'tentang',
                        'success' => 'alur_prosedur',
                        'warning' => 'syarat',
                        'danger' => 'tutorial',
                    ]),
                Tables\Columns\TextColumn::make('judul')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('gambar'),
            ])
            ->defaultSort('urutan')
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->options([
                        'tentang' => 'Tentang TTE',
                        'alur_prosedur' => 'Alur & Prosedur',
                        'syarat' => 'Persyaratan',
                        'tutorial' => 'Video Tutorial',
                    ])
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
            'index' => Pages\ListTteInfos::route('/'),
            'create' => Pages\CreateTteInfo::route('/create'),
            'edit' => Pages\EditTteInfo::route('/{record}/edit'),
        ];
    }
}
