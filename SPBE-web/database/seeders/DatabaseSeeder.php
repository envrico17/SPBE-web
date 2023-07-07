<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Document;
use App\Models\Indicator;
use App\Models\Aspect;
use App\Models\Domain;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@material.com',
            'password' => ('secret'),
        ]);

        Domain::factory()->count(3)->create();

        Aspect::factory()->count(5)->create();

        Indicator::factory()->count(7)->create();

        Document::factory()->count(10)->create([
            'user_id' => 1,
            'indicator_id' => Indicator::inRandomOrder()
                                ->first()->id
        ]);

        // Aspect::factory()->for($domains)->create();
        // $indicators = Indicator::factory()->for($aspects)->create();
        // $documents = Document::factory()->for($indicators)->for($users)
        //     ->create();
    }
}
