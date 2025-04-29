<?php

namespace App\Filament\Widgets;

use Filament\Widgets\LineChartWidget;
use App\Models\Order;

class OrderPerMonthChartWidget extends LineChartWidget
{
    protected static ?string $heading = 'Orders per month';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $months = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];
        $orders = Order::query()
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = (int) ($orders[$i] ?? 0);
        }
        return [
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => $data,
                    'borderColor' => '#fbbf24',
                    'backgroundColor' => 'rgba(251,191,36,0.1)',
                ],
            ],
            'labels' => $months,
        ];
    }
}
