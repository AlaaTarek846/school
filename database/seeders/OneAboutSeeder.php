<?php

namespace Database\Seeders;

use App\Models\OneAbout;
use App\Models\AboutDetail;
use App\Models\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class OneAboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        OneAbout::truncate();
        AboutDetail::truncate();
        File::where('uploadable_type', OneAbout::class)->delete();
        Schema::enableForeignKeyConstraints();

        // Create the main OneAbout record
        $oneAbout = OneAbout::create([
            'title_ar' => 'عن المدرسة',
            'title_en' => 'About the School',
            'description_ar' => 'مرحبًا بكم في مدرسة كوبري الجلاء، حيث يلتقي العلم بالإلهام، وتُقدَّر رحلة كل طالب التعليمية. تأسست مدرستنا عام 1988، وقد كانت على مدار 36 عامًا صرحًا للتعليم المتميز والابتكار وخدمة المجتمع.',
            'description_en' => 'Welcome to Kobery El Galaa School, where knowledge meets inspiration and every student’s educational journey is valued. Established in 1988, our school has been a cornerstone of excellence in education, innovation, and community service for 36 years.',
            'title_color_ar' => 'يونيبيكس',
            'title_color_en' => 'Unipix',
            'years_experience' => '51',
            'url' => '#',
        ]);

        // Create the image file for OneAbout
        // Need a user for uploaded_by. Assuming ID 1 exists or created elsewhere.
        // We can fetch first user.
        $user = \App\Models\User::first();
        $userId = $user ? $user->id : 1;

        File::create([
            'url' => '/storage/oneAbout/about-01.jpg',
            'identifier' => 'first_photo',
            'uploadable_id' => $oneAbout->id,
            'uploadable_type' => OneAbout::class,
            'name' => 'about-01.jpg',
            'size' => 0,
            'mime_type' => 'image/jpeg',
            'uploaded_by' => $userId,
        ]);


        // Create related details
        $details = [
            [
                'title_ar' => 'طلاب المراحل الدراسية المختلفة',
                'title_en' => 'undergraduate and graduate students',
                'image' => '/storage/oneAboutDetails/11.svg',
                'count' => '20000',
            ],
            [
                'title_ar' => 'الهيئة التعليمية والإدارية بمدرسة يونيبيكس',
                'title_en' => 'Unipix University Faculty and Staff',
                'image' => '/storage/oneAboutDetails/12.svg',
                'count' => '16214',
            ],
            [
                'title_ar' => 'خريجي يونيبيكس حول العالم',
                'title_en' => 'Unipix Alumni Worldwide',
                'image' => '/storage/oneAboutDetails/13.svg',
                'count' => '300',
            ],
        ];

        foreach ($details as $detail) {
            AboutDetail::create([
                'one_about_id' => $oneAbout->id,
                'title_ar' => $detail['title_ar'],
                'title_en' => $detail['title_en'],
                'image' => $detail['image'],
                'count' => (int) str_replace(',', '', $detail['count']),
            ]);
        }
    }
}
