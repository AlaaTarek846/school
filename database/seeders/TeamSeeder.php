<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Partner;
use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::truncate();

        $teams = [
            [
                'name_ar' => "سي. هانا أوينو",
                'name_en' => "C. Hannah Ueno",
                'job_ar' => "أستاذ مساعد",
                'job_en' => "Assistant Professor",
                'url' => '/storage/team/teacher__1.jpg',
            ],
            [
                'name_ar' => "توماس فريد",
                'name_en' => "Thomas Fred",
                'job_ar' => "أستاذ مشارك في التاريخ",
                'job_en' => "Associate Professor of History",
                'url' => '/storage/team/teacher__2.jpg',
            ],
            [
                'name_ar' => "جينيفر آرونز",
                'name_en' => "Jennifer Aarons",
                'job_ar' => "أستاذ الفنون",
                'job_en' => "Professor of Art",
                'url' => '/storage/team/teacher__3.jpg',
            ],
            [
                'name_ar' => "مايكل ماكغارفي",
                'name_en' => "Michael McGarvey",
                'job_ar' => "أستاذ الأدب",
                'job_en' => "Professor of Literature",
                'url' => '/storage/team/teacher__4.jpg',
            ],
        ];

        foreach ($teams as $team) {
            $model = Team::create([
                'name_ar' => $team['name_ar'],
                'name_en' => $team['name_en'],
                'job_ar' => $team['job_ar'],
                'job_en' => $team['job_en'],
            ]);
            $model->media()->create([
                'name' =>  $team['name_en'],
                'size' => 444,
                'mime_type' => 'image/jpeg',
                'identifier' => null,
                'uploaded_by' =>  1,
                'url' => $team['url'],
            ]);
        }

    }
}