<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BranchAddress;
use App\Models\Branch;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BranchAddress>
 */
class BranchAddressFactory extends Factory
{
    protected $model = BranchAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'branch_id' => Branch::factory(),
            'address' => fake()->streetAddress(),
            'zip_code' => fake()->postcode(false),
            'complement' => null,
            'district' => fake()->city(),
            'city' => fake()->city(),
            'state' => fake()->stateAbbr(),
        ];
    }
}
