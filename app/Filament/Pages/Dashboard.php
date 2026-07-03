<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\DashboardStatsWidget::class,
            \App\Filament\Widgets\VisitorStatsWidget::class, // ✅ Tambahkan ini

            // ini yang penting
        ];
    }
}
