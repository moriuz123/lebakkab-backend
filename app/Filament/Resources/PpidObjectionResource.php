<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PpidObjectionResource\Pages;
use App\Filament\Resources\PpidObjectionResource\RelationManagers;
use App\Models\PpidObjection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PpidObjectionResource extends Resource
{
    protected static ?string $model = PpidObjection::class;

    protected static ?string $navigationIcon = 'heroicon-o-scale';
    protected static ?string $navigationGroup = 'Layanan PPID';
    protected static ?string $modelLabel = 'Pengajuan Keberatan';
    protected static ?string $pluralModelLabel = 'Pengajuan Keberatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make([
                    Forms\Components\Section::make('Data Keberatan')
                        ->schema([
                            Forms\Components\Select::make('ppid_request_id')
                                ->label('Permohonan Awal')
                                ->relationship('ppidRequest', 'kode_registrasi')
                                ->searchable()
                                ->required(),
                            Forms\Components\Select::make('alasan_keberatan')
                                ->options([
                                    'Permohonan Ditolak' => 'Permohonan Ditolak',
                                    'Informasi Berkala Tidak Disediakan' => 'Informasi Berkala Tidak Disediakan',
                                    'Permintaan Tidak Ditanggapi' => 'Permintaan Tidak Ditanggapi',
                                    'Permintaan Ditanggapi Tidak Sesuai' => 'Permintaan Ditanggapi Tidak Sesuai',
                                    'Biaya Tidak Wajar' => 'Biaya Tidak Wajar',
                                    'Penyampaian Informasi Melebihi Waktu' => 'Penyampaian Informasi Melebihi Waktu',
                                ])
                                ->required(),
                            Forms\Components\Textarea::make('kasus_posisi')
                                ->label('Penjelasan / Kasus Posisi')
                                ->required()
                                ->columnSpanFull(),
                            Forms\Components\FileUpload::make('dokumen_keputusan')
                                ->label('Dokumen Keputusan (File Jawaban Admin)')
                                ->directory('ppid/keputusan')
                                ->acceptedFileTypes(['application/pdf'])
                                ->columnSpanFull(),
                        ])->columns(2),
                ])->columnSpan(2),

                Forms\Components\Group::make([
                    Forms\Components\Section::make('Status & Admin')
                        ->schema([
                            Forms\Components\Select::make('status')
                                ->options([
                                    'Menunggu' => 'Menunggu',
                                    'Diproses' => 'Diproses',
                                    'Selesai Sengketa' => 'Selesai Sengketa',
                                ])
                                ->required(),
                            Forms\Components\Textarea::make('admin_note')
                                ->label('Catatan Admin')
                                ->columnSpanFull(),
                        ]),
                ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ppidRequest.kode_registrasi')
                    ->label('Kode Permohonan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('alasan_keberatan')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'Menunggu',
                        'primary' => 'Diproses',
                        'success' => 'Selesai Sengketa',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pengajuan')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPpidObjections::route('/'),
            'create' => Pages\CreatePpidObjection::route('/create'),
            'edit' => Pages\EditPpidObjection::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (!auth()->user()->hasRole('super_admin')) {
            $query->whereHas('ppidRequest', function ($q) {
                $q->where('opd_id', auth()->user()->opd_id);
            });
        }

        return $query;
    }
}
