<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Video::truncate();
        $links = [
            'https://youtu.be/WwJyS1YOb7Q',
            'https://youtu.be/Ly-cfbLKqeI',
            'https://youtu.be/9PG77doUgZA',
            'https://youtu.be/ndDipi8OR74',
            'https://youtu.be/b_Xg-Y4v0zw',
        ];

        foreach ($links as $link) {
            Video::create([
                'link' => $link,
            ]);
        }
    }
}
