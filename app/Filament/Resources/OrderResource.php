<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationGroup = 'Tienda';
    protected static ?string $navigationLabel = 'Órdenes';
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function getNavigationBadge(): ?string
    {
        return (string) \App\Models\Order::count();
    }

    public static function getNavigationBadgeColor(): string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)
                ->schema([
                    Forms\Components\TextInput::make('number')
                        ->label('Número')
                        ->default(fn () => 'OR-' . fake()->unique()->numberBetween(100000, 999999))
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\Select::make('customer_id')
                        ->label('Cliente')
                        ->relationship('customer', 'name')
                        ->searchable()
                        ->createOptionForm([
                            Forms\Components\TextInput::make('name')->label('Nombre')->required(),
                            Forms\Components\TextInput::make('email')->label('Correo')->email()->required(),
                            Forms\Components\TextInput::make('phone')->label('Teléfono'),
                        ])
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\ToggleButtons::make('status')
                        ->label('Estado')
                        ->options([
                            'shipped' => 'Enviado',
                            'processing' => 'Procesando',
                            'new' => 'Nuevo',
                            'delivered' => 'Entregado',
                            'cancelled' => 'Cancelado',
                        ])
                        ->icons([
                            'shipped' => 'heroicon-o-truck',
                            'processing' => 'heroicon-o-arrow-path',
                            'new' => 'heroicon-o-plus-circle',
                            'delivered' => 'heroicon-o-check-circle',
                            'cancelled' => 'heroicon-o-x-circle',
                        ])
                        ->colors([
                            'shipped' => 'success',
                            'processing' => 'warning',
                            'new' => 'primary',
                            'delivered' => 'success',
                            'cancelled' => 'danger',
                        ])
                        ->inline(false)
                        ->required()
                        ->columnSpan(2)
                        ->extraAttributes(['class' => 'order-status-toggle']),
                    Forms\Components\Select::make('currency')
                        ->label('Moneda')
                        ->options([
                            'USD' => 'USD',
                            'EUR' => 'EUR',
                            'MXN' => 'MXN',
                        ])
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\Select::make('country')
                        ->label('País')
                        ->options([
                            'US' => 'Estados Unidos',
                            'MX' => 'México',
                            'ES' => 'España',
                        ])
                        ->searchable()
                        ->required()
                        ->columnSpan(1),
                ]),
            Forms\Components\Card::make()
                ->schema([
                    Forms\Components\TextInput::make('address')
                        ->label('Dirección')
                        ->columnSpanFull(),
                    Forms\Components\Grid::make(3)
                        ->schema([
                            Forms\Components\TextInput::make('city')
                                ->label('Ciudad'),
                            Forms\Components\TextInput::make('state')
                                ->label('Estado / Provincia'),
                            Forms\Components\TextInput::make('zip')
                                ->label('Código Postal'),
                        ]),
                    Forms\Components\Textarea::make('notes')
                        ->label('Notas')
                        ->rows(2),
                ]),
            Forms\Components\Section::make('Productos de la orden')
                ->schema([
                    Forms\Components\Repeater::make('orderItems')
                        ->label('Productos de la orden')
                        ->relationship()
                        ->schema([
                            Forms\Components\Select::make('product_id')
                                ->label('Producto')
                                ->relationship('product', 'name')
                                ->required(),
                            Forms\Components\TextInput::make('quantity')
                                ->label('Cantidad')
                                ->numeric()
                                ->minValue(1)
                                ->default(1)
                                ->required(),
                        ])
                        ->createItemButtonLabel('Agregar producto')
                        ->columns(2),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number')->label('Número')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('customer.name')->label('Cliente')->sortable()->searchable(),
                Tables\Columns\BadgeColumn::make('status')->label('Estado')
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
                Tables\Columns\TextColumn::make('currency')->label('Moneda')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('total')->label('Total')->sortable()
                    ->formatStateUsing(fn ($state) => '$' . number_format($state ?? 0, 2)),
                // Tables\Columns\TextColumn::make('shipping_cost')->label('Costo de envío')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Fecha de orden')->date('d/m/Y')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Filtrar por estado')
                    ->options([
                        '' => 'Todos',
                        'new' => 'Nuevo',
                        'processing' => 'Procesando',
                        'shipped' => 'Enviado',
                        'delivered' => 'Entregado',
                        'cancelled' => 'Cancelado',
                    ]),
            ])
            ->searchable()
            ->paginated(true)
            ->defaultPaginationPageOption(10)
            ->paginationPageOptions([10, 25, 50, 100]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
