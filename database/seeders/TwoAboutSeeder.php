<?php

namespace Database\Seeders;

use App\Models\TwoAbout;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TwoAboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TwoAbout::factory()->count(1)->create();
    }
}
