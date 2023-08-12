<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


use App\Models\Indicator;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Score>
 */
class ScoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'score_name' => fake()->sentence(1),
            'score_description' => fake()->sentence(2),
            'score_date' => fake()->year('+5 years'),
            'score_date_range' => null,
        ];
    }
}
