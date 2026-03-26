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
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        EducationStage::truncate();
        \App\Models\Subject::truncate();
        \App\Models\SchoolClass::truncate();

        $stages = [
            ['title_ar' => 'حضانة 1', 'title_en' => 'KG 1'],
            ['title_ar' => 'حضانة 2', 'title_en' => 'KG 2'],
            ['title_ar' => 'الاول الابتدائي', 'title_en' => 'Primary 1'],
            ['title_ar' => 'الثاني الابتدائي', 'title_en' => 'Primary 2'],
            ['title_ar' => 'الثالث الابتدائي', 'title_en' => 'Primary 3'],
            ['title_ar' => 'الرابع الابتدائي', 'title_en' => 'Primary 4'],
            ['title_ar' => 'الخامس الابتدائي', 'title_en' => 'Primary 5'],
            ['title_ar' => 'السادس الابتدائي', 'title_en' => 'Primary 6'],
            ['title_ar' => 'الاول الاعدادي', 'title_en' => 'Preparatory 1'],
            ['title_ar' => 'الثاني الاعدادي', 'title_en' => 'Preparatory 2'],
            ['title_ar' => 'الثالث الاعدادي', 'title_en' => 'Preparatory 3'],
            ['title_ar' => 'الاول الثانوي', 'title_en' => 'Secondary 1'],
            ['title_ar' => 'الثاني الثانوي', 'title_en' => 'Secondary 2'],
            ['title_ar' => 'الثالث الثانوي', 'title_en' => 'Secondary 3'],
        ];

        foreach ($stages as $stageData) {
            $stage = EducationStage::create($stageData);

            // Add Default Subjects for each stage
            $subjects = [
                ['title_ar' => 'لغة عربية', 'title_en' => 'Arabic'],
                ['title_ar' => 'لغة انجليزية', 'title_en' => 'English'],
                ['title_ar' => 'رياضيات', 'title_en' => 'Mathematics'],
            ];
            
            if (strpos($stageData['title_en'], 'KG') === false) {
                $subjects[] = ['title_ar' => 'علوم', 'title_en' => 'Science'];
                $subjects[] = ['title_ar' => 'دراسات اجتماعية', 'title_en' => 'Social Studies'];
            }

            foreach ($subjects as $subject) {
                $stage->subjects()->create($subject);
            }

            // Add Default Classes for each stage
            $classes = [
                ['name' => 'A'],
                ['name' => 'B'],
                ['name' => 'C'],
            ];

            foreach ($classes as $class) {
                $stage->schoolClasses()->create($class);
            }
        }
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();
    }
}
