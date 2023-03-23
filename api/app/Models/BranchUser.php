<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Branch;
use App\Models\User;
use App\Models\Role;

class BranchUser extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function branch(): HasOne
    {
        return $this->hasOne(Branch::class);
    }

    public function role(): HasOne 
    {
        return $this->hasOne(Role::class);
    }
}
