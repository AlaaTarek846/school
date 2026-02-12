<?php

namespace Database\Seeders\Home;

use App\Models\HomeSlider;
use Illuminate\Database\Seeder;

class HomeSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomeSlider::truncate();

        $model = HomeSlider::create([
            'title_ar'       => "المنزل قد يكون  ",
            'title_color_ar' => "مكان مريح",
            'title_en'       => "Home Might Be ",
            'title_color_en' => "Conformable Place",  
            "description_ar" => "هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى",
            "description_en" => "This text is an example of text that can be replaced in the same space, this text has been generated from the Arabic text generator",
            'status'         => 1,
        ]);

        $model->media()->create([
            'name' =>  $model['title_en'],
            'size' => 444,
            'mime_type' => 'sdd',
            'identifier' => 'background',
            'uploaded_by' =>  1,
            'url' => '/storage/home-slider/main-slider-two-img-1.jpg',
        ]);



        $model = HomeSlider::create([
             'title_ar'       => "المنزل قد يكون  ",
            'title_color_ar' => "مكان مريح",
            'title_en'       => "Home Might Be ",
            'title_color_en' => "Conformable Place",  
            "description_ar" => "هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى",
            "description_en" => "This text is an example of text that can be replaced in the same space, this text has been generated from the Arabic text generator",  
            'status'         => 1,
        ]);

        $model->media()->create([
            'name' =>  $model['title_en'],
            'size' => 444,
            'mime_type' => 'sdd',
            'identifier' => 'background',
            'uploaded_by' =>  1,
            'url' => '/storage/home-slider/main-slider-two-img-2.jpg',
        ]);


        $model = HomeSlider::create([
            'title_ar'       => "المنزل قد يكون  ",
            'title_color_ar' => "مكان مريح",
            'title_en'       => "Home Might Be ",
            'title_color_en' => "Conformable Place",    
            "description_ar" => "هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى",
            "description_en" => "This text is an example of text that can be replaced in the same space, this text has been generated from the Arabic text generator",  
            'status'         => 1,
        ]);

        $model->media()->create([
            'name' =>  $model['title_en'],
            'size' => 444,
            'mime_type' => 'sdd',
            'identifier' => 'background',
            'uploaded_by' =>  1,
            'url' => '/storage/home-slider/main-slider-two-img-3.jpg',
        ]);


     }
}
