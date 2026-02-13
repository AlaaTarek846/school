<?php

namespace Database\Seeders;

use App\Models\CampusTour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampusTourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CampusTour::factory()->count(1)->create();
    }
}
