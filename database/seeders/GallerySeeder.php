<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gallery::truncate();
        for ($i = 1; $i <= 12; $i++) {
            $imageName = sprintf('%02d.jpg', $i);
            Gallery::create([
                'image' => '/storage/gallery/' . $imageName,
            ]);
        }
    }
}
