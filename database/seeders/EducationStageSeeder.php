<?php

namespace Database\Seeders;

use App\Models\EducationStage;
use Illuminate\Database\Seeder;

class EducationStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stages = [
            ['title_ar' => 'حضانة', 'title_en' => 'KG 1'],
            ['title_ar' => 'روضة', 'title_en' => 'KG 2'],
            ['title_ar' => 'الاول الابتدائي', 'title_en' => 'Primary 1'],
            ['title_ar' => 'الثاني الابتدائي', 'title_en' => 'Primary 2'],
            ['title_ar' => 'الثالث الابتدائي', 'title_en' => 'Primary 3'], // Corrected from الثالث الثانوي based on context
            ['title_ar' => 'الرابع الابتدائي', 'title_en' => 'Primary 4'],
            ['title_ar' => 'الخامس الابتدائي', 'title_en' => 'Primary 5'],
            ['title_ar' => 'السادس الابتدائي', 'title_en' => 'Primary 6'],
            ['title_ar' => 'الاول الاعدادي', 'title_en' => 'Preparatory 1'],
            ['title_ar' => 'الثاني الاعدادي', 'title_en' => 'Preparatory 2'],
            ['title_ar' => 'الثالث الاعدادي', 'title_en' => 'Preparatory 3'],
            ['title_ar' => 'الاول الثانوي', 'title_en' => 'Secondary 1'],
            ['title_ar' => 'الثاني الثانوي', 'title_en' => 'Secondary 2'],
            ['title_ar' => 'الثالث الثانوي', 'title_en' => 'Secondary 3'], // Corrected from الثاني الثانوي
        ];

        foreach ($stages as $stage) {
            EducationStage::updateOrCreate(
                ['title_en' => $stage['title_en']], // Check by English title to avoid duplicates
                ['title_ar' => $stage['title_ar']]
            );
        }
    }
}
