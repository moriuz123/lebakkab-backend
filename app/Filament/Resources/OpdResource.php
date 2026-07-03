<?php

namespace App\Filament\Resources;

use App\Models\Opd;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use App\Filament\Resources\OpdResource\Pages;

class OpdResource extends Resource
{
    protected static ?string $model = Opd::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationLabel = 'Data OPD';
    protected static ?string $slug = 'opd';
    protected static ?string $navigationGroup = 'Kelola Konten';



    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nama')
                ->label('Nama OPD')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(function (\Filament\Forms\Set $set, $state) {
                    $set('slug', Str::slug($state));
                }),

            TextInput::make('slug')
                ->label('Slug')
                ->disabled()
                ->dehydrated(),

            TextInput::make('singkatan'),
            TextInput::make('pimpinan')
                ->label('Nama Pimpinan'),

            Textarea::make('deskripsi'),

            TextInput::make('email')->email(),
            TextInput::make('telepon'),
            TextInput::make('website')->url()->prefix('https://'),

            Textarea::make('alamat'),

            FileUpload::make('logo')
                ->label('Logo')
                ->image()
                ->directory('opd')
                ->preserveFilenames(),

            FileUpload::make('foto_kantor')
                ->label('Foto Kantor')
                ->image()
                ->directory('opd')
                ->preserveFilenames(),

            Textarea::make('peta_embed')
                ->label('Embed Peta'),

            TextInput::make('urutan')
                ->numeric()
                ->default(0),

            Toggle::make('is_published')
                ->label('Tampilkan di Frontend')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->width(40),

                TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->wrap(),

                TextColumn::make('singkatan'),
                TextColumn::make('pimpinan'),

                TextColumn::make('telepon'),

                IconColumn::make('is_published')
                    ->label('Publikasi')
                    ->boolean(),

                TextColumn::make('urutan'),
            ])
            ->defaultSort('urutan', 'asc')
            ->filters([
                // Tambahkan filter jika diperlukan
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
            'index' => Pages\ListOpds::route('/'),
            'create' => Pages\CreateOpd::route('/create'),
            'edit' => Pages\EditOpd::route('/{record}/edit'),
        ];
    }
}
