<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recitation = \App\Models\AchievementSection::where('title_en', 'Recitation & Innovation')->first()->id;
        $sports = \App\Models\AchievementSection::where('title_en', 'Sports Excellence')->first()->id;

        $achievements = [
            // Recitation & Innovation
            [
                'achievement_section_id' => $recitation,
                'icon' => 'fa-microphone-stand',
                'text_ar' => 'الإنجاز 1 - مسابقة الإلقاء',
                'text_en' => 'Achievement 1 - Recitation Competition',
                'badge_icon' => 'fa-trophy',
            ],
            [
                'achievement_section_id' => $recitation,
                'icon' => 'fa-microphone-stand',
                'text_ar' => 'الإنجاز 2 - الخطابة',
                'text_en' => 'Achievement 2 - Public Speaking',
                'badge_icon' => 'fa-trophy',
            ],
            [
                'achievement_section_id' => $recitation,
                'icon' => 'fa-lightbulb-on',
                'text_ar' => 'الإنجاز 3 - الابتكار العلمي',
                'text_en' => 'Achievement 3 - Scientific Innovation',
                'badge_icon' => 'fa-trophy',
            ],
            // Sports Excellence
            [
                'achievement_section_id' => $sports,
                'icon' => 'fa-table-tennis-paddle-ball',
                'text_ar' => 'الإنجاز 4 - تنس الطاولة',
                'text_en' => 'Achievement 4 - Table Tennis',
                'badge_icon' => 'fa-medal',
            ],
            [
                'achievement_section_id' => $sports,
                'icon' => 'fa-person-swimming',
                'text_ar' => 'الإنجاز 5 - السباحة',
                'text_en' => 'Achievement 5 - Swimming',
                'badge_icon' => 'fa-medal',
            ],
            [
                'achievement_section_id' => $sports,
                'icon' => 'fa-basketball',
                'text_ar' => 'الإنجاز 6 - كرة السلة',
                'text_en' => 'Achievement 6 - Basketball',
                'badge_icon' => 'fa-medal',
            ],
            [
                'achievement_section_id' => $sports,
                'icon' => 'fa-person-swimming',
                'text_ar' => 'الإنجاز 7 - البطولات المائية',
                'text_en' => 'Achievement 7 - Water Championships',
                'badge_icon' => 'fa-medal',
            ],
        ];

        foreach ($achievements as $achievement) {
            \App\Models\Achievement::create($achievement);
        }
    }
}
