<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TteRegistrationResource\Pages;
use App\Models\TteRegistration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Card;

class TteRegistrationResource extends Resource
{
    protected static ?string $model = TteRegistration::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';
    protected static ?string $navigationGroup = 'SPON TTE';
    protected static ?string $navigationLabel = 'Pengajuan TTE';
    protected static ?string $pluralModelLabel = 'Pengajuan TTE';
    protected static ?int $navigationSort = 1;

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
                    Forms\Components\Select::make('opd_id')
                        ->relationship('opd', 'nama')
                        ->label('Instansi / OPD')
                        ->searchable()
                        ->required(),
                    Forms\Components\TextInput::make('nik')
                        ->label('NIK')
                        ->maxLength(20)
                        ->required(),
                    Forms\Components\TextInput::make('nama_lengkap')
                        ->label('Nama Lengkap')
                        ->required(),
                    Forms\Components\TextInput::make('nip')
                        ->label('NIP')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('jabatan')
                        ->label('Jabatan')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required(),
                    Forms\Components\TextInput::make('no_hp')
                        ->label('Nomor WhatsApp / HP')
                        ->required(),
                    Forms\Components\FileUpload::make('surat_rekomendasi')
                        ->label('Surat Rekomendasi (PDF)')
                        ->acceptedFileTypes(['application/pdf'])
                        ->directory('tte/rekomendasi')
                        ->required(),
                    Forms\Components\Select::make('status')
                        ->options([
                            'menunggu' => 'Menunggu',
                            'diproses' => 'Diproses',
                            'selesai' => 'Selesai',
                            'ditolak' => 'Ditolak',
                        ])
                        ->default('menunggu')
                        ->required(),
                    Forms\Components\Textarea::make('catatan_admin')
                        ->label('Catatan Admin')
                        ->maxLength(65535)
                        ->columnSpanFull(),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Tanggal Pengajuan')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable(),
                Tables\Columns\TextColumn::make('opd.nama')
                    ->label('Instansi / OPD')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('no_hp')
                    ->label('No. HP'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'menunggu',
                        'primary' => 'diproses',
                        'success' => 'selesai',
                        'danger' => 'ditolak',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'menunggu' => 'Menunggu',
                        'diproses' => 'Diproses',
                        'selesai' => 'Selesai',
                        'ditolak' => 'Ditolak',
                    ]),
                Tables\Filters\SelectFilter::make('opd_id')
                    ->relationship('opd', 'nama')
                    ->label('Filter OPD'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Download Surat')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn (TteRegistration $record) => $record->surat_rekomendasi ? \Illuminate\Support\Facades\Storage::url($record->surat_rekomendasi) : null)
                    ->openUrlInNewTab()
                    ->visible(fn (TteRegistration $record) => $record->surat_rekomendasi !== null),
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
            'index' => Pages\ListTteRegistrations::route('/'),
            'create' => Pages\CreateTteRegistration::route('/create'),
            'edit' => Pages\EditTteRegistration::route('/{record}/edit'),
        ];
    }
}
