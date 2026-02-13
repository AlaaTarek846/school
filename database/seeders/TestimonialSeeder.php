<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\File;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Testimonial::truncate();
        File::where('uploadable_type', Testimonial::class)->delete();
        Schema::enableForeignKeyConstraints();

        $descriptionEn = "I would highly recommend Michael Richard to anyone interested the subject matter. It has provided me with invaluable knowledge & a newfound passion topic. My only suggestion would be to add more live.";
        $descriptionAr = "أنصح بشدة بـMichael Richard لأي شخص مهتم بهذا الموضوع. لقد زودني بمعرفة لا تُقدَّر بثمن وشغف جديد تجاه هذا المجال. اقتراحي الوحيد هو إضافة المزيد من الجلسات الحية";
        
        $images = [
            '/storage/testimonial/author-1.png',
            '/storage/testimonial/author-2.png',
            '/storage/testimonial/author-3.png'
        ];

        $names = ['Sarah Jones', 'David Smith', 'Emily Wilson'];
        $jobsEn = ['Student', 'Designer', 'Developer'];
        $jobsAr = ['طالب', 'مصمم', 'مطور'];

        $user = \App\Models\User::first();
        $userId = $user ? $user->id : 1;

        foreach ($images as $index => $image) {
            $testimonial = Testimonial::create([
                'name_ar' => $names[$index],
                'job_ar' => $jobsAr[$index],
                'job_en' => $jobsEn[$index],
                'description_ar' => $descriptionAr,
                'description_en' => $descriptionEn,
                'status' => true,
                'rating' => 5,
            ]);

            File::create([
                'name' => basename($image),
                'size' => 1024, // Dummy size
                'url' => $image,
                'uploaded_by' => $userId,
                'uploadable_id' => $testimonial->id,
                'uploadable_type' => Testimonial::class,
                'identifier' => 'avatar', // or whatever identifier is expected
                'mime_type' => 'image/png'
            ]);
        }
    }
}
