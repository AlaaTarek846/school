<?php

namespace Database\Seeders;

use App\Models\SchoolDisciplinePolicy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolDisciplinePolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SchoolDisciplinePolicy::query()->truncate();

        $images = [
            '/storage/school_discipline_policies/لائحة-الانضباط-المدرسي-1-1o-scaled.jpg',
            '/storage/school_discipline_policies/لائحة-الانضباط-المدرسي-1-1-scaled.jpg',
            '/storage/school_discipline_policies/لائحة-الانضباط-المدرسي-31-1-scaled.jpg',
        ];

        foreach ($images as $image) {
            SchoolDisciplinePolicy::create([
                'image' => $image,
            ]);
        }
    }
}
