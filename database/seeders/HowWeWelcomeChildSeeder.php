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
                'title_ar' => 'في يومه الأول بالمدرسة:',
                'title_en' => 'On his first day at school:',
                'description_ar' => 'تعمل المدرسة على أن يهيأ الطفل ذهنيا لتقبل الحياة الجديدة التي يمكن أن يحياها.
تشعر المدرسة على أنه أصبح بين زملاء متساويين معه في كل شيء.',
                'description_en' => 'Going to school is an important event and great change in the life of the child.
Going to school represents a great change in the child s social environment and this change needs a lot of caring and protection to adapt their new lifestyle .',
                'image' => '/storage/how_we_welcome_child/Recieving-2.png',
            ],
            [
                'title_ar' => 'دور مدرسة لاروز دي ليزيه:',
                'title_en' => 'Role of La Rose des Sables School:',
                'description_ar' => 'دور مدرسة لاروز دي ليزيه:
إن دور المدرسة لا يقتصر على تعليم الأطفال القراءة والكتابة والحساب، بل يمتد ليشمل جوانب متعددة في شخصية الطفل، منها الجانب الاجتماعي، والانفعالي، والوجداني، والمهاري، والجمالي، والروحي، والأخلاقي، والوطني، والقيمي، والاجتماعي، والوجداني، والمهاري، والجمالي، والروحي، والأخلاقي، والوطني، والقيمي.',
                'description_en' => 'LA ROSE DE LISIEUX is adapting the childs brain to accept the new lifestyle they are living .',
                'image' => '/storage/how_we_welcome_child/Recieving-1.png',
            ],
            [
                'title_ar' => 'المدرسة تساعد أطفالها على التكيف مع الحياة:',
                'title_en' => 'The school helps its children adapt to life:',
                'description_ar' => 'تغرس في ذهن الطفل حب المدرسة وأن المدرسة شيء جميل فهي مكان للمكافأة وللنجاح والفلاح. تعمل على النحو النفسي والخلقي والاجتماعي للطفل وتعمل على تمتع الطفل بطفولته وذلك لأن تمتع الطفل بطفولة سعيدة يحتمل أن يحيا أيضا مراهقة سعيدة والمراهق السعيد الذي يحيا مراهقة موفقة يشب شابا سعيدا. تعمل المدرسة على تغيير كثير من العادات السلوكية التي تحتاج إلى تغيير شامل عند دخول المدرسة مثل النوم والاستيقاظ وتناول الطعام.',
                'description_en' => 'LA ROSE DE LISIEUX is adapting the childs brain to accept the new lifestyle they are living .',
                'image' => '/storage/how_we_welcome_child/كيف-يستقبل-الطفل-.jpg',
            ],
            [
                'title_ar' => 'أما عن الإعداد النفسي:',
                'title_en' => 'As for the psychological preparation:',
                'description_ar' => 'أما عن الإعداد النفسي:
تعمل على أن يتعود على إقامة العلاقات والاتصالات مع زملائه، وكذلك تساعده على فرص الاشتراك في الأنشطة الرياضية والألعاب مع غيره من أقران السن.
تهتم المدرسة بالعلاقة المهمة بين المنزل والمدرسة التي تساعد في تكيف الطفل داخل المدرسة والمنزل على حد سواء تكيفا لا في التحصيل الدراسي فحسب وإنما أيضا في النمو النفسي والعاطفي الانفعالي.
تجعل الفهم متبادل بين المدرسة والمنزل مما يجعل تكيف الطفل وسهولة نمو شخصيته من النواحي المعرفية والجسمية والعقلية والنفسية.
تقدم المدرسة وتستقبل الطفل بمدرسات لأنهن يشبهن في كثير من الخصائص الجوهرية الأم، فالمعلمة تصبح بديلة عن الأم إلى حد كبير.
تقدم المدرسة للطفل بعض الألعاب الرياضية والأنشطة الترويحية والحركية والغناء والموسيقى والرقص دون إرهاق ذهن الطفل بالمواد الدراسية في هذه المرحلة المبكرة من حياته.',
                'description_en' => '
It helps the child get used to establishing relationships and communication with peers, and also provides opportunities to participate in sports and games with other children of the same age.
The school pays attention to the important relationship between home and school, which aids the child s adaptation both at school and at home—not only in academic achievement but also in psychological and emotional development.
It fosters mutual understanding between the school and the home, which facilitates the child s adaptation and the smooth growth of their personality cognitively, physically, mentally, and emotionally.
The school welcomes the child with female teachers, as they resemble the mother in many essential characteristics; the teacher thus becomes, to a large extent, a substitute for the mother.
The school offers the child some sports, recreational and motor activities, singing, music, and dancing without overloading the child s mind with academic subjects at this early stage of life."',
                'image' => null,
            ],
        ];
        foreach ($data as $item) {
            HowWeWelcomeChild::create($item);
        }
    }
}
