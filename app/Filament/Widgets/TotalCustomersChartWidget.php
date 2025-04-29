<?php

namespace App\Filament\Widgets;

use Filament\Widgets\LineChartWidget;
use App\Models\Customer;

class TotalCustomersChartWidget extends LineChartWidget
{
    protected static ?string $heading = 'Clientes totales';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $months = [
            'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
            'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'
        ];
        $totals = [];
        $cumulative = 0;
        $customers = Customer::query()
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');
        for ($i = 1; $i <= 12; $i++) {
            $cumulative += (int) ($customers[$i] ?? 0);
            $totals[] = $cumulative;
        }
        return [
            'datasets' => [
                [
                    'label' => 'Clientes',
                    'data' => $totals,
                    'borderColor' => '#fbbf24',
                    'backgroundColor' => 'rgba(251,191,36,0.1)',
                ],
            ],
            'labels' => $months,
        ];
    }
}
