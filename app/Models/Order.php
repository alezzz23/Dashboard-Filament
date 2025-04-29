<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'customer_id',
        'status',
        'total',
        'currency',
        'country',
        'address',
    ];

    public function recalculateTotal()
    {
        $total = 0;
        foreach ($this->orderItems as $item) {
            if ($item->product && $item->quantity) {
                $total += $item->product->price * $item->quantity;
            }
        }
        $this->total = $total;
        $this->saveQuietly();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}