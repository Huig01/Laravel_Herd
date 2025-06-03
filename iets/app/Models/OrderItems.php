<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
    ];

    // Relatie met order
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    // Relatie met product
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
