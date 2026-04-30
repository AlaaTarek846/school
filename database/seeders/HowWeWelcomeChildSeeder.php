<?php

namespace Database\Seeders;

use App\Models\HowWeWelcomeChild;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HowWeWelcomeChildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HowWeWelcomeChild::truncate();
        $data = [
            [
                'title_ar' => 'التميز التعليمي (Excellence)',
                'title_en' => 'Educational Excellence',
                'description_ar' => 'تسعى مدرسة الجلاء لتحقيق أعلى معايير الجودة في التعليم من خلال كوادر تعليمية متميزة وبيئة تعليمية محفزة تضمن تفوق طلابنا الأكاديمي والمهاري.',
                'description_en' => 'Galaa School strives to achieve the highest standards of quality in education through distinguished educational cadres and a stimulating educational environment that ensures our students academic and skillful excellence.',
                'image' => '/storage/core_values/excellence.png',
            ],
            [
                'title_ar' => 'النزاهة والأخلاق (Integrity)',
                'title_en' => 'Integrity and Ethics',
                'description_ar' => 'نؤمن في مدرسة الجلاء بأن التربية تسبق التعليم، لذا نغرس في طلابنا قيم الصدق، والأمانة، والمسؤولية الأخلاقية تجاه أنفسهم ومجتمعهم.',
                'description_en' => 'At Galaa School, we believe that education precedes instruction. Therefore, we instill in our students the values of honesty, integrity, and moral responsibility towards themselves and their community.',
                'image' => '/storage/core_values/integrity.png',
            ],
            [
                'title_ar' => 'الاحترام والتعاون (Respect)',
                'title_en' => 'Respect and Cooperation',
                'description_ar' => 'نبني مجتمعاً مدرسياً قائماً على الاحترام المتبادل وتقدير الآخر، مع تعزيز روح العمل الجماعي والتعاون بين الطلاب والمعلمين وأولياء الأمور.',
                'description_en' => 'We build a school community based on mutual respect and appreciation of others, while promoting the spirit of teamwork and cooperation among students, teachers, and parents.',
                'image' => '/storage/core_values/respect.png',
            ],
            [
                'title_ar' => 'الابتكار والتطوير (Innovation)',
                'title_en' => 'Innovation and Development',
                'description_ar' => 'نشجع طلابنا على التفكير الإبداعي والابتكار، ونواكب أحدث التطورات التكنولوجية في طرق التدريس لإعداد جيل قادر على مواجهة تحديات المستقبل.',
                'description_en' => 'We encourage our students to think creatively and innovate, and we keep pace with the latest technological developments in teaching methods to prepare a generation capable of facing future challenges.',
                'image' => '/storage/core_values/innovation.png',
            ],
        ];
        foreach ($data as $item) {
            HowWeWelcomeChild::create($item);
        }
    }
}
