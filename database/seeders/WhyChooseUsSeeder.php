<?php

namespace Database\Seeders;

use App\Models\WhyChooseUs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WhyChooseUsDetail;
use Illuminate\Support\Facades\Schema;

class WhyChooseUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        WhyChooseUs::truncate();
        WhyChooseUsDetail::truncate();
        Schema::enableForeignKeyConstraints();

        $mainRecord = WhyChooseUs::create([
            'title_ar' => 'لماذا تختار لاروز دي ليزيه للغات',
            'title_en' => 'Why choose La Rose De Lisieux Schools',
            'description_ar' => 'يتعلم الطالب والطالبة كيف يجمع بين ممارسة هواياته ومذكراته بأسلوب سهل بسيط حيث يصل في نهاية هذه المرحلة لخلق شخصية حازمة مهذبة ناجحة بأعلى الدرجات.
 ويعد إعداد الطالب للاعتماد على ذاته كليا وجزئيا مع المرحلة الإعدادية إلى لاروز دي ليزيه الثانوية حيث الحزم المحترم والشدة المتفهمة لطبيعة هذه المرحلة من العمر وهي المراهقة
 فنجد المعاملة التربوية الخالصة والتي تهدف إلى مساعدة الطالب لتحديد طريقه في الحياة ومساعدته على التوفيق بين قدراته ورغباته وذلك حتى يلتحق بالكلية التي تتناسب مع قدراته ورغباته معا
ولا تقل لاروز الثانوي عن الإعدادي والابتدائي في احتفاظها بالصدارة في مراكزها الأولى على مستوى الجمهورية وتخريج الطلبة إلى كليات القمة.
هكذا هي لاروز دي ليزيه بجميع مراحلها منذ الطفولة وحتى أولى مراحل النضج والثبات والخروج إلى الحياة العملية، هذه هي قلعة العلم التي يسعى الكثيرون للالتحاق بها لمواكبة ركب التقدم والحضارة في مصر.',
            'description_en' => 'Students learn to combine their hobbies and interests with their education through a simple and seamless manner that positively aids in the development of a strongminded, positive and successful personality all the while maintaining the highest marks. Entering adolescence, we encourage our students to explore their individuality and independence all the while maintaining criterias of strictness and understanding to guide them through their high school stage.
Our educational program is devoted to helping our students seek their path in life and empower them with the ability of applying their skills and talents to their goals.
La Rose De Lisieux is an educational fort that fosters care, compassion and educational distinction from childhood to the early stages of adolescence, through a strict yet compassionate educational program, we empower and encourage our students to reach for excellence, understanding that we are a stepping stone in their personal journey and a foundation of its promising beginning.',
            'image' => '/storage/whyChooseUs/1.png',
            'status' => true,
        ]);

        $details = [
            [
                'title_ar' => 'في الدولة في مجال البحث والتطوير للمواد',
                'title_en' => 'in the nation for materials R&D',
                'count' => 1,
            ],
            [
                'title_ar' => 'كليات تصنع المستقبل',
                'title_en' => 'Colleges that Create Futures',
                'count' => 10,
            ],
            [
                'title_ar' => 'معدل النجاح بعد التخرج',
                'title_en' => 'post-graduation success rate',
                'count' => 90,
            ],
        ];

        foreach ($details as $detail) {
            WhyChooseUsDetail::create([
                'why_choose_us_id' => $mainRecord->id,
                'title_ar' => $detail['title_ar'],
                'title_en' => $detail['title_en'],
                'count' => $detail['count'],
                // 'image' => ... check if needed
            ]);
        }
    }
    
}
