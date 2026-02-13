<?php

namespace Database\Seeders;

use App\Models\HowWeWelcomeChild;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HowWeWelcomeChildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HowWeWelcomeChild::factory()->count(5)->create();
    }
}
