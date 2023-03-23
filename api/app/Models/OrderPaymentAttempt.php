<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use App\Models\CustomerPaymentMethod;
use App\Models\Order;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\OrderPaymentAttemptStatus;

class OrderPaymentAttempt extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'attempt',
        'status',
        'meta'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status'    => OrderPaymentAttemptStatus::class,
        'meta'      => AsArrayObject::class
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function payment_method(): BelongsTo
    {
        return $this->belongsTo(CustomerPaymentMethod::class);
    }
}
