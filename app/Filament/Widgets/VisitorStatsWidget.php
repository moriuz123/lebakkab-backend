<?php

namespace App\Filament\Widgets;

use App\Models\Visitor;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class VisitorStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $query = \App\Filament\Support\OpdFields::applyOpdScope(Visitor::query());
        $totalVisitors = (clone $query)->count();
        $todayVisitors = (clone $query)->whereDate('visited_at', today())->count();
        $uniqueIPs = (clone $query)->distinct('ip_address')->count('ip_address');

        return [
            Stat::make('Total Kunjungan', number_format($totalVisitors))
                ->description('Semua kunjungan situs'),
            Stat::make('Kunjungan Hari Ini', number_format($todayVisitors))
                ->description('Dihitung sejak 00:00'),
            Stat::make('IP Unik', number_format($uniqueIPs))
                ->description('Pengunjung unik berdasarkan IP'),
        ];
    }
}
