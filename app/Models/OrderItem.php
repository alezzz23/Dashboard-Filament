<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
    ];

    protected static function booted()
    {
        static::saved(function ($orderItem) {
            if ($orderItem->order) {
                $orderItem->order->recalculateTotal();
            }
        });
        static::deleted(function ($orderItem) {
            if ($orderItem->order) {
                $orderItem->order->recalculateTotal();
            }
        });
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
