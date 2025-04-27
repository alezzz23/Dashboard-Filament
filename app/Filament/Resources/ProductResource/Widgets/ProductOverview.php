<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class ProductOverview extends StatsOverviewWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Products', \App\Models\Product::count()),
            Card::make('In Stock', \App\Models\Product::where('stock', '>', 0)->count()),
            Card::make('Out of Stock', \App\Models\Product::where('stock', '<=', 0)->count()),
        ];
    }
}
