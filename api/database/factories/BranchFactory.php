<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Branch;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Branch>
 */
class BranchFactory extends Factory
{
    protected $model = Branch::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $same = fake()->company();

        return [
            'name'          => $same,
            'trading_name'  => $same,
            'company_name'  => fake()->company(),
            'document'      => fake()->cnpj(),
        ];
    }
}
