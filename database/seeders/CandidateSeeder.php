<?php

namespace Database\Seeders;

use App\Models\Candidate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Candidate::create([
            'name' => fake()->name,
            'source' => fake()->name,
            'owner' => 1,
            'created_by' => 1,
        ]);
        Candidate::create([
            'name' => fake()->name,
            'source' => fake()->name,
            'owner' => 2,
            'created_by' => 2,
        ]);
        Candidate::factory(10)->create();
    }
}
