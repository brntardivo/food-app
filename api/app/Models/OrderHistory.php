<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\OrderHistoryEvent;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Order;

class OrderHistory extends Model
{
    use HasFactory, HasUuids;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'event',
        'meta'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'event'     => OrderHistoryEvent::class,
        'meta'      => AsArrayObject::class
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
