<?php

namespace Database\Seeders;

use App\Models\CampusTour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampusTourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CampusTour::truncate();
        
        CampusTour::create([
            'title_ar' => 'جولة في حرمنا المدرسة',
            'title_en' => 'Our Campus Tour',
            'description_ar' => 'ابدأ رحلة من المعرفة والاكتشاف والنمو في Unipix University. تم تصميم عملية القبول لدينا للتعرف على الأفراد المتميزين والمتحمسين الذين يتطلعون للمساهمة في مجتمعنا الأكاديمي الديناميكي. سواء كنت خريجًا حديثًا من المدرسة الثانوية أو طالب تحويل يبحث عن بيت أكاديمي جديد، ندعوك لاستكشاف الفرص التي تنتظرك.',
            'description_en' => "Embark on a journey of knowledge, discovery, and growth at Unipix University. Our admissions process is designed to identify bright, motivated individuals who are eager to contribute to our dynamic academic community. Whether you're a recent high school graduate or a transfer student seeking a new academic home, we invite you to explore the possibilities that await you.",
            'image' => '/storage/campus_tour/video-thumb.jpg',
            'link' => 'https://youtu.be/WwJyS1YOb7Q',
        ]);
    }
}
