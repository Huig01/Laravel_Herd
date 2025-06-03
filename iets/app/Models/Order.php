<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_date',
        'status',
    ];

    // Relatie met gebruiker
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relatie met order items
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
