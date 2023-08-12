<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Score;
use App\Models\Aspect;
use App\Models\Domain;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Indicator>
 */
class IndicatorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'indicator_name' => fake()->words(2, true),
            'description' => fake()->sentence(4),
            'aspect_id' => Aspect::factory(),
        ];
    }
}
