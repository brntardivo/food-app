<?php

namespace App\Models;

use App\Helpers\CNPJFormatter;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'trading_name',
        'company_name',
        'document',
    ];

    protected function document(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => CNPJFormatter::format($value),
            set: fn (string $value) => CNPJFormatter::parse($value),
        );
    }

    public function address(): HasOne
    {
        return $this->hasOne(BranchAddress::class);
    }

    public function opening_hours_settings(): HasMany
    {
        return $this->hasMany(BranchOpeningHoursSetting::class);
    }

    public function employees(): HasMany
    {
        return $this->hasMany(BranchUser::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
