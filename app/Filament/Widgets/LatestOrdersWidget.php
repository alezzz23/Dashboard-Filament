<?php

namespace App\Filament\Widgets;

use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use App\Models\Order;

class LatestOrdersWidget extends BaseWidget
{
    protected static ?string $heading = 'Latest Orders';
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(Order::query()->latest('created_at'))
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Order Date')
                    ->date('M d, Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('number')
                    ->label('Number')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Customer')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'primary' => 'new',
                        'warning' => 'processing',
                        'success' => ['shipped', 'delivered'],
                        'danger' => 'cancelled',
                    ])
                    ->icons([
                        'heroicon-o-truck' => 'shipped',
                        'heroicon-o-check-circle' => 'delivered',
                        'heroicon-o-arrow-path' => 'processing',
                        'heroicon-o-plus-circle' => 'new',
                        'heroicon-o-x-circle' => 'cancelled',
                    ]),
                Tables\Columns\TextColumn::make('currency')
                    ->label('Currency')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('total')
                    ->label('Total price')
                    ->sortable(),
                Tables\Columns\TextColumn::make('shipping_cost')
                    ->label('Shipping cost')
                    ->formatStateUsing(fn () => 'Open')
                    ->color('warning'),
            ])
            ->searchable()
            ->paginated(true)
            ->defaultPaginationPageOption(5)
            ->paginationPageOptions([5, 10, 25, 50]);
    }
}
