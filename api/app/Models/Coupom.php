<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Enums\CoupomType;
use App\Models\Order;

class Coupom extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'enabled',
        'quantity',
        'type',
        'price',
        'percentage',
        'available_in',
        'expires_in'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'type'          => CoupomType::class,
        'available_in'  => 'datetime',
        'expires_in'    => 'datetime'
    ];

    public function orders(): HasMany {
        return $this->hasMany(Order::class);
    }
}
