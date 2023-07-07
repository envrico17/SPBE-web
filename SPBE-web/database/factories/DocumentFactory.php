<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Indicator;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'doc_name' => fake()->sentence(),
            'upload_path' => null,
            'user_id' => User::inRandomOrder()->first()->id,
            'indicator_id' => Indicator::inRandomOrder()->first()->id
        ];
    }
}
