<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Opd>
 */
class OpdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'opd_name' => fake()->sentence(2),
            'opd_alias' => fake()->words(1, true),
            'user_id' => User::factory()
        ];
    }
}
