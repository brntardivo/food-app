<?php

namespace App\Models;

use App\Enums\CustomerPaymentMethodType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerPaymentMethod extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tokenized_card',
        'type',
        'anonymized_numbers',
        'name',
        'owner_document',
        'expiration',
        'default',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'type' => CustomerPaymentMethodType::class,
    ];

    protected function ownerDocument(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                switch(strlen($value)) {
                    case 14:
                        return CNPJFormatter::format($value);
                    case 11:
                        return CPFFormatter::format($value);
                    default:
                        return $value;
                }
            },
            set: function (string $value) {
                switch(strlen($value)) {
                    case 18:
                        return CNPJFormatter::parse($value);
                    case 14:
                        return CPFFormatter::parse($value);
                    default:
                        return $value;
                }
            }
        );
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function payment_attempts(): HasMany
    {
        return $this->hasMany(OrderPaymentAttempt::class);
    }
}
