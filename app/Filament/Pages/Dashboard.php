<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\OrderPerMonthChartWidget;
use App\Filament\Widgets\TotalCustomersChartWidget;
use App\Filament\Widgets\LatestOrdersWidget;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            OrderPerMonthChartWidget::class,
            TotalCustomersChartWidget::class,
            LatestOrdersWidget::class,
        ];
    }
}
