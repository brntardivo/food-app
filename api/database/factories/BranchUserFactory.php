<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\BranchUser;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BranchUser>
 */
class BranchUserFactory extends Factory
{
    protected $model = BranchUser::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'branch_id' => Branch::factory(),
            'user_id' => User::factory(),
            'role_id' => Role::factory(),
        ];
    }
}
