<?php

namespace Database\Seeders;

use App\Models\WhyChooseUs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WhyChooseUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WhyChooseUs::factory()->count(1)->create();
    }
}
