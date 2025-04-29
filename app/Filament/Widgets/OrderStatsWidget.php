<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Order;

class OrderStatsWidget extends BaseWidget
{
    public ?string $heading = null;
    protected static ?int $sort = 1;

    protected function getCards(): array
    {
        // Gráfica de órdenes por mes
        $ordersByMonth = Order::query()
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');
        $ordersChart = [];
        for ($i = 1; $i <= 12; $i++) {
            $ordersChart[] = (int) ($ordersByMonth[$i] ?? 0);
        }

        $ordersCount = Order::count();
        $openOrders = Order::whereIn('status', ['new', 'processing'])->count();
        $averagePrice = Order::avg('total') ?? 0;

        return [
            Card::make('Órdenes', number_format($ordersCount))
                ->chart($ordersChart),
            Card::make('Órdenes abiertas', number_format($openOrders)),
            Card::make('Precio promedio', number_format($averagePrice, 2)),
        ];
    }
}
