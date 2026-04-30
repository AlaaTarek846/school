<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AchievementSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'title_ar' => 'الإلقاء والابتكار',
                'title_en' => 'Recitation & Innovation',
                'border_color' => '#435ffb', 
                'background_color' => '#f8f9ff',
            ],
            [
                'title_ar' => 'التميز الرياضي',
                'title_en' => 'Sports Excellence',
                'border_color' => '#e83e8c',
                'background_color' => '#fff5f8',
            ],
        ];

        foreach ($sections as $section) {
            \App\Models\AchievementSection::create($section);
        }
    }
}
