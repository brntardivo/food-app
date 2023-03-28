<?php

namespace App\Models;

use App\Helpers\ZipCodeFormatter;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerAddress extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'address',
        'complement',
        'district',
        'zip_code',
        'city',
        'state',
        'default',
    ];

    protected function zipCode(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ZipCodeFormatter::format($value),
            set: fn (string $value) => ZipCodeFormatter::parse($value),
        );
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
