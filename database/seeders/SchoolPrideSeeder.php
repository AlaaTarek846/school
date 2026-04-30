<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolPrideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prides = [
            [
                'card_type' => 'left',
                'image' => '/assets/images/about/history.jpeg',
                'overlay_icon' => 'fa-solid fa-crown',
                'overlay_text_ar' => 'المركز الأول',
                'overlay_text_en' => '1st Place',
                'title_ar' => 'العرض الرياضي 2022',
                'title_en' => 'Sports Display 2022',
                'description_ar' => 'جائزة المدرسة 1',
                'description_en' => 'School Award 1',
            ],
            [
                'card_type' => 'right',
                'icon' => 'fa-light fa-users-medical',
                'title_ar' => 'المجتمع والأنشطة',
                'title_en' => 'Community & Activities',
                'description_ar' => 'جائزة المدرسة 2',
                'description_en' => 'School Award 2',
            ],
        ];

        foreach ($prides as $pride) {
            \App\Models\SchoolPride::create($pride);
        }
    }
}
