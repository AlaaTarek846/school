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
                'name' => " جون برادشو",
                'job' => "Senior Advisor",
                'url' => '/storage/team/team-2-1.jpg',
            ],
            [
                'name' => " نيك باول",
                'job' => "Leader",
                'url' => '/storage/team/team-2-2.jpg',
            ],
            [
                'name' => " إليزابيث ليلى",
                'job' => "Designer",
                'url' => '/storage/team/team-2-3.jpg',
            ],
            [
                'name' => " بول ووكر",
                'job' => "Director",
                'url' => '/storage/team/team-2-4.jpg',
            ],
        ];

        foreach ($teams as $team) {
            $model = Team::create([
                'name' => $team['name'],
                'job' => $team['job'],
            ]);
            $model->media()->create([
                'name' =>  $team['name'],
                'size' => 444,
                'mime_type' => 'sdd',
                'identifier' => null,
                'uploaded_by' =>  1,
                'url' => $team['url'],
            ]);
        }

    }
}