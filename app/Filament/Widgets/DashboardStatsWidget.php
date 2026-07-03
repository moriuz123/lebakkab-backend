<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Dokumen;
use App\Models\InformasiLayanan;

class DashboardStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Berita', \App\Filament\Support\OpdFields::applyOpdScope(Berita::query())->count())
                ->description('Jumlah berita tersedia')
                ->color('primary'),

            Stat::make('Pengumuman', \App\Filament\Support\OpdFields::applyOpdScope(Pengumuman::query())->count())
                ->description('Jumlah pengumuman tersedia')
                ->color('success'),

            Stat::make('Dokumen', \App\Filament\Support\OpdFields::applyOpdScope(Dokumen::query())->count())
                ->description('Jumlah dokumen tersedia')
                ->color('warning'),

            Stat::make('Informasi Layanan', \App\Filament\Support\OpdFields::applyOpdScope(InformasiLayanan::query())->count())
                ->description('Jumlah info layanan tersedia')
                ->color('danger'),
        ];
    }
}
