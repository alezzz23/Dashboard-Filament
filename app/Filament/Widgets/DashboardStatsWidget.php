<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Support\Carbon;

class DashboardStatsWidget extends BaseWidget
{
    protected function getCards(): array
    {
        // Revenue mensual
        $revenueByMonth = Order::query()
            ->selectRaw('MONTH(created_at) as month, SUM(total) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');
        $revenueChart = [];
        for ($i = 1; $i <= 12; $i++) {
            $revenueChart[] = (float) ($revenueByMonth[$i] ?? 0);
        }
        $revenueTotal = array_sum($revenueChart);
        $revenueDiff = $revenueChart[date('n')-1] - ($revenueChart[date('n')-2] ?? 0);
        $revenueDesc = ($revenueDiff >= 0 ? '+' : '') . number_format($revenueDiff, 2) . ' este mes';
        $revenueDescColor = $revenueDiff >= 0 ? 'success' : 'danger';
        $revenueDescIcon = $revenueDiff >= 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down';

        // Nuevos clientes mensuales
        $customersByMonth = Customer::query()
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');
        $customersChart = [];
        for ($i = 1; $i <= 12; $i++) {
            $customersChart[] = (int) ($customersByMonth[$i] ?? 0);
        }
        $customersTotal = array_sum($customersChart);
        $customersDiff = $customersChart[date('n')-1] - ($customersChart[date('n')-2] ?? 0);
        $customersDesc = ($customersDiff >= 0 ? '+' : '') . $customersDiff . ' este mes';
        $customersDescColor = $customersDiff >= 0 ? 'success' : 'danger';
        $customersDescIcon = $customersDiff >= 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down';

        // Nuevas órdenes mensuales
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
        $ordersTotal = array_sum($ordersChart);
        $ordersDiff = $ordersChart[date('n')-1] - ($ordersChart[date('n')-2] ?? 0);
        $ordersDesc = ($ordersDiff >= 0 ? '+' : '') . $ordersDiff . ' este mes';
        $ordersDescColor = $ordersDiff >= 0 ? 'success' : 'danger';
        $ordersDescIcon = $ordersDiff >= 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down';

        return [
            Card::make('Revenue', '$' . number_format($revenueTotal, 2, '.', ','))
                ->description($revenueDesc)
                ->descriptionIcon($revenueDescIcon)
                ->descriptionColor($revenueDescColor)
                ->chart($revenueChart)
                ->color($revenueDescColor),
            Card::make('New customers', number_format($customersTotal))
                ->description($customersDesc)
                ->descriptionIcon($customersDescIcon)
                ->descriptionColor($customersDescColor)
                ->chart($customersChart)
                ->color($customersDescColor),
            Card::make('New orders', number_format($ordersTotal))
                ->description($ordersDesc)
                ->descriptionIcon($ordersDescIcon)
                ->descriptionColor($ordersDescColor)
                ->chart($ordersChart)
                ->color($ordersDescColor),
        ];
    }
}
