<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Filament\Widgets\OrderStatsWidget;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrderStatsWidget::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            'new' => Tab::make('New')->query(fn ($query) => $query->where('status', 'new')),
            'processing' => Tab::make('Processing')->query(fn ($query) => $query->where('status', 'processing')),
            'shipped' => Tab::make('Shipped')->query(fn ($query) => $query->where('status', 'shipped')),
            'delivered' => Tab::make('Delivered')->query(fn ($query) => $query->where('status', 'delivered')),
            'cancelled' => Tab::make('Cancelled')->query(fn ($query) => $query->where('status', 'cancelled')),
        ];
    }
}
