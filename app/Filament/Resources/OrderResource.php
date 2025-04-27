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

    protected static ?string $navigationGroup = 'Shop';
    protected static ?string $navigationLabel = 'Orders';
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
                        ->label('Number')
                        ->default(fn () => 'OR-' . fake()->unique()->numberBetween(100000, 999999))
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\Select::make('customer_id')
                        ->label('Customer')
                        ->relationship('customer', 'name')
                        ->searchable()
                        ->createOptionForm([
                            Forms\Components\TextInput::make('name')->required(),
                            Forms\Components\TextInput::make('email')->email()->required(),
                            Forms\Components\TextInput::make('phone'),
                        ])
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\ToggleButtons::make('status')
                        ->label('Status')
                        ->options([
                            'shipped' => 'Shipped',
                            'processing' => 'Processing',
                            'new' => 'New',
                            'delivered' => 'Delivered',
                            'cancelled' => 'Cancelled',
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
                        ->label('Currency')
                        ->options([
                            'USD' => 'USD',
                            'EUR' => 'EUR',
                            'MXN' => 'MXN',
                        ])
                        ->required()
                        ->columnSpan(1),
                    Forms\Components\Select::make('country')
                        ->label('Country')
                        ->options([
                            'US' => 'United States',
                            'MX' => 'Mexico',
                            'ES' => 'Spain',
                        ])
                        ->searchable()
                        ->required()
                        ->columnSpan(1),
                ]),
            Forms\Components\Card::make()
                ->schema([
                    Forms\Components\TextInput::make('address')
                        ->label('Street address')
                        ->columnSpanFull(),
                    Forms\Components\Grid::make(3)
                        ->schema([
                            Forms\Components\TextInput::make('city')
                                ->label('City'),
                            Forms\Components\TextInput::make('state')
                                ->label('State / Province'),
                            Forms\Components\TextInput::make('zip')
                                ->label('Zip / Postal code'),
                        ]),
                    Forms\Components\Textarea::make('notes')
                        ->label('Notes')
                        ->rows(2),
                ]),
            Forms\Components\Section::make('Order Items')
                ->schema([
                    Forms\Components\Repeater::make('orderItems')
                        ->label('Order Items')
                        ->relationship()
                        ->schema([
                            Forms\Components\Select::make('product_id')
                                ->label('Product')
                                ->relationship('product', 'name')
                                ->required(),
                            Forms\Components\TextInput::make('quantity')
                                ->label('Quantity')
                                ->numeric()
                                ->minValue(1)
                                ->default(1)
                                ->required(),
                        ])
                        ->createItemButtonLabel('Add Product')
                        ->columns(2),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
            Tables\Columns\TextColumn::make('number')->label('Order Number')->sortable(),
            Tables\Columns\TextColumn::make('customer.name')->label('Customer')->sortable(),
            Tables\Columns\TextColumn::make('total')->label('Total')->sortable(),
            Tables\Columns\TextColumn::make('status')->label('Status')->sortable(),
            Tables\Columns\TextColumn::make('created_at')->label('Created')->dateTime('d/m/Y')->sortable(),
        ])->actions([
            Tables\Actions\EditAction::make(),
        ]);
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
