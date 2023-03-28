<?php

namespace App\Models;

use App\Enums\OrderDeliveryStatus;
use App\Enums\OrderOverallStatus;
use App\Enums\OrderPaymentType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'overall_status',
        'payment_type',
        'delivery_type',
        'paid',
        'total_price',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'overall_status' => OrderOverallStatus::class,
        'payment_type' => OrderPaymentType::class,
        'delivery_type' => OrderDeliveryStatus::class,
    ];

    public function products(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function delivery_attempts(): HasMany
    {
        return $this->hasMany(OrderDeliveryAttempt::class);
    }

    public function payment_attempts(): HasMany
    {
        return $this->hasMany(OrderPaymentAttempt::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(OrderHistory::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}
