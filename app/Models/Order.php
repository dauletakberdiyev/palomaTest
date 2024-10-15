<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $place_id
 * @property int $total_cost
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
final class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';

    protected $fillable = [
        'place_id',
        'total_cost',
        'created_at',
        'updated_at'
    ];

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetails::class, 'order_id', 'id');
    }
}
