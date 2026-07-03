<?php

namespace App\Filament\Support;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class OpdFields
{
    public static function applyOpdScope(Builder $query): Builder
    {
        if (auth()->check() && !auth()->user()->hasRole('super_admin') && auth()->user()->opd_id) {
            $query->where('opd_id', auth()->user()->opd_id);
        }
        return $query;
    }
    public static function form(bool $withTampilDiPortal = true): array
    {
        $fields = [
            Select::make('opd_id')
                ->label('OPD Pemilik')
                ->relationship('opd', 'nama')
                ->searchable()
                ->preload()
                ->nullable()
                ->default(fn () => auth()->check() ? auth()->user()->opd_id : null)
                ->disabled(fn () => auth()->check() && !auth()->user()->hasRole('super_admin') && auth()->user()->opd_id)
                ->dehydrated(),
        ];

        if ($withTampilDiPortal) {
            $fields[] = Toggle::make('tampil_di_portal')
                ->label('Tampil di Portal Utama')
                ->default(true);
        }

        return $fields;
    }

    public static function tableColumns(): array
    {
        return [
            TextColumn::make('opd.nama')
                ->label('OPD')
                ->searchable()
                ->sortable()
                ->toggleable(),
        ];
    }

    public static function filters(): array
    {
        return [
            SelectFilter::make('opd_id')
                ->label('OPD')
                ->relationship('opd', 'nama')
                ->searchable()
                ->preload()
                ->hidden(fn () => auth()->check() && !auth()->user()->hasRole('super_admin') && auth()->user()->opd_id),
        ];
    }
}
