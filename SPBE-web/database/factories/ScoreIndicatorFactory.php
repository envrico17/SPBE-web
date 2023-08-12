<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ScoreIndicator>
 */
class ScoreIndicatorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate random score and description
        $score = $this->faker->numberBetween(1, 5);
        $description = $this->faker->sentence;

        return [
            'indicator_id' => $this->faker->unique()->numberBetween(1, 47), // Ensure unique indicator_id
            'score_id' => 1,
            'score' => $score,
            'score_description' => $description,
        ];
    }
}
