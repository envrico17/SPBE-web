<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Document;
use App\Models\Indicator;
use App\Models\Aspect;
use App\Models\Domain;
use App\Models\Opd;
use Illuminate\Database\Eloquent\Factories\Sequence;

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
            'user_type' => 'admin',
            'email' => 'admin@material.com',
            'password' => ('secret'),
        ]);

        User::factory()->create([
            'name' => 'Supervisor',
            'user_type' => 'supervisor',
            'email' => 'supervisor@material.com',
            'password' => ('secret'),
        ]);

        Domain::factory()->count(4)->create();

        Aspect::factory()->count(8)->state(new Sequence(
            fn (Sequence $sequence) => ['domain_id' => Domain::all()->random()]
        ))->create();

        Indicator::factory()->count(45)->state(new Sequence(
            fn (Sequence $sequence) => ['aspect_id' => Aspect::all()->random()]
        ))->create();

        Opd::factory()->count(15)->create();

        // Indicator::factory()->count(46)->sequence(
        //     ['aspect_id' => Aspect::inRandomOrder()->first()->id]
        // )->create();
    }
}
