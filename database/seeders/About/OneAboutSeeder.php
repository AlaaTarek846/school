<?php

namespace Database\Seeders\About;

use App\Models\AboutDetail;
use App\Models\OneAbout;
use Illuminate\Database\Seeder;

class OneAboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $model = OneAbout::create([
            'years_experience' => 150,
            'url' => 'https://www.youtube.com/watch?v=5CLmRIHR5Zw',
            'title_ar' => "ابق جافًا ومريحًا مع خدماتنا الخبيرة في الأسقف",
            'title_color_ar' => "معلومات عنا.",
            'description_ar' => 'ضع استراتيجيات بقاء رابحة للجميع لضمان الهيمنة الاستباقية. في نهاية المطاف، من الآن فصاعدًا، أصبح الوضع الطبيعي الجديد، الذي تطور من الوضع التشغيلي X، على وشك الظهور.',
            'title_en' => "Stay dry and comfortable with our expert roofing services",
            'title_color_en' => "ABOUT US.",
            'description_en' => 'Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day going forward, a new normal that has evolved from operational X is on the runway.'
        ]);

        $aboutDetail1 = AboutDetail::create([
            'one_about_id' => $model->id,
            'title_ar' =>  "نرتقي فوق الجميع، سقفًا بعد سقف",
            'title_en' => "Rising Above the Rest Roof by Roof",
        ]);
        $aboutDetail2 = AboutDetail::create([
            'one_about_id' => $model->id,
            'title_ar' => "ارفع مأواك ارفع حياتك",
            'title_en' => "Elevate Your Shelter Elevate Your Life",
        ]);
        $aboutDetail3 = AboutDetail::create([
            'one_about_id' => $model->id,
            'title_ar' => "حراس أفقك، سقف بفخر",
            'title_en' => "Guardians of Your Horizon, Roofing with Pride",
        ]);
        $aboutDetail4 = AboutDetail::create([
            'one_about_id' => $model->id,
            'title_ar' =>   "حماية المنازل سقفًا واحدًا في كل مرة",
            'title_en' => "Safeguarding Homes One Roof at a Time",
        ]);
        $model->media()->create([
            'name' =>  'first_photo',
            'size' => 444,
            'mime_type' => 'sdd',
            'identifier' => 'first_photo',
            'uploaded_by' =>  1,
            'url' => '/storage/oneAbout/about-two-img-1.jpg',
        ]);

    }
}