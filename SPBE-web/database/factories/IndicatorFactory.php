<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Indicator;
use App\Models\Aspect;

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
            'score' => null,
            'aspect_id' => Aspect::factory(),
        ];
    }
}
