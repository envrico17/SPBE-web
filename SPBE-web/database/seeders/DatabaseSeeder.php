<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Document;
use App\Models\Indicator;
use App\Models\Aspect;
use App\Models\Domain;
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
            'user_type' => 0,
            'email' => 'admin@material.com',
            'password' => ('secret'),
        ]);

        User::factory()->create([
            'name' => 'User 1',
            'user_type' => 1,
            'email' => 'user@material.com',
            'password' => ('secret'),
        ]);

        User::factory()->create([
            'name' => 'Supervisor',
            'user_type' => 2,
            'email' => 'supervisor@material.com',
            'password' => ('secret'),
        ]);

        Domain::factory()->count(4)->create();

        Aspect::factory()->count(8)->sequence(
            [
                'domain_id' => Domain::inRandomOrder()
                                ->first()->id
            ]
        )->create();

        Indicator::factory()->count(46)->sequence(
            [
                'aspect_id' => Aspect::inRandomOrder()
                                ->first()->id
            ]
        )->create();

        Document::factory()->count(80)
        ->sequence(
            ['upload_path'=>null],
            ['upload_path'=>'/path/to/document']
        )
        ->create([
            'user_id' => 1,
            'indicator_id' => Indicator::inRandomOrder()
                                ->first()->id
        ]);

        Document::factory()->count(210)
        ->sequence(
            ['upload_path'=>null],
            ['upload_path'=>'/path/to/document']
        )
        ->create([
            'user_id' => 2,
            'indicator_id' => Indicator::inRandomOrder()
                                ->first()->id
        ]);
    }
}
