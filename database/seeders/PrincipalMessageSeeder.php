<?php

namespace Database\Seeders;

use App\Models\PrincipalMessage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrincipalMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PrincipalMessage::query()->truncate();

        PrincipalMessage::create([
            'title_ar' => 'كلمة المدير',
            'title_en' => 'Principal Message',
            'description_ar' => 'بدأت مسيرتي التعليمية منذ أن عملت كأستاذ بكلية الهندسة جامعة عين شمس ثم التحقت بمجال التربية والتعليم إيمانا مني بأهمية هذا المجال ورغبة مني في تقديم خدمات للأجيال الجديدة وقد شغلت العديد من الوظائف بالتوجيه العام في العديد من الإدارات والتي قدمت فيها خبراتي التعليمية كأستاذ تربوي، وقد كان عملي الكبير مع القيادات التعليمية وفي مقدمتهم أ.د/ مصطفى كمال حلمي - أ.د/ منصور حسين- أ.د/ أحمد عبد الآخر، الفضل في إضافة الكثير إلى المنظومة التعليمية والتربوية التي رغبت في تحقيقها تحت شعار (جيل يستشعر طريق النجاح من خلال ساعدتنا وخبراتنا). واستمرت الخبرات إلى أن تقلدت منصب وكيل أول بوزارة التربية والتعليم وكان لإشرافي على العديد من المدارس الفضل في تعرفي على هيئة راهبات الفاتيكان المالكة لمدرسة لاروز دي ليزيه حينذاك، ومن خلال العلافات الطيبة معهم تم الاتفاق بيننا على انتقال الملكية إلىَّ، وذلك لعدم تفرغ الراهبات لإدارة المدرسة وقتها، وكان ذلك دافعا وهدفنا لبداية استثماري لخبراتي في مجال التعليم. استطعت بعد انتقال ملكية المدرسة لي أن أنهض بها من المرحلة الابتدائية إلى مراحل تعليمية متكاملة تصل بالتلميذ حتى الجامعة، ونظرا لأن مدرسة لاروز دي ليزيه من أقدم المدارس في محافظة الجيزة والتي كان يدرس بها المواد باللغة الفرنسية كلغة اولى. ولما كان الاتجاه نحو اللغة الإنجليزية فقد قمت بتحويلها إلى مدرسة لغات إنجليزي لتصبح المدرسة الخاصة الوحيدة في محافظة الجيزة في ذلك الوقت، ثم حذت حذوها العديد من المدارس الحالية بعد ذلك. وتشرف المدرسة بأن أبناءها خريجي المدرسة شغلوا العديد من المناصب القيادية في مختلف الوزارات. ومما يزيد من فخري ان بعضهم يقومون بإلحاق أبنائهم بمدرسة لاروز دي ليزيه إيمانا منهم برسالتنا وثقة منهم في توجيه أبنائهم للطريق السليم، وأن المدرسة تحقق نجاحات في نتائجها 100% في جميع المراحل التعليمية والشهادات، بل ومنها الأوائل على مدار سنوات منذ توليت إدارتها. والحمد لله توجت جهودي باختياري رئيسا لجمعية المدارس الخاصة على مستوى الجمهورية، وتم تكريمي بحصولي على وسام الريادة كرائد للتعليم الخاص. واستطعت أن أنقل خبراتي التعليمية إلى ابنتي د.م نيفين مطاوع والاستاذة شرين مطاوع لاستكمال المسيرة السامية. وفقنا الله لما فيه صالح الوطن...',
            'description_en' => "As one of Cairo's most established and most academic schools, La Rose De Lisieux serves those parents and students who are looking for an excellent education in a purposeful and productive but caring and supportive environment. The school has a strong tradition of examination success and our pupils go on to the best regional universities when they leave us.

When our students leave La Rose De Lisieux, they do so with the qualifications and qualities needed to face the demands, pressures and exciting challenges of an increasingly complex and integrated global community; with good friends; happy memories of sports and games played, music, drama, concerts, school trips and a thousand and one other school activities and events as well as a deep and abiding affection for us.
I started my career and path as a professor at the faculty of engineering at Ein Shams University and then there was my true beginning in the field of education. I started off by working in managerial inspection positions over at many different schools in many areas, especially the Dokki governorate. that point my main tasks were carried out with many big icons in the field of education, like Mansour Hussein, Ahmed Abdel Akher, Mostafa Kamal Helmy and much more.

My experiences developed and I moved up the rank until I reached top assistance for the ministry of education. One of the schools that I had under my jurisdiction was La Rose De Lisieux. At that time It was owned by the nuns of the Vatican and through our kind and excellent relationships together, I managed to buy the school off the Vatican and officially initiate the beginning of private schools ownership, where I managed to convert La Rose De Lisieux to schools with stages starting from Kindergarten up until secondary school, then another alteration occurred, which was from a French school to an English Language school. This conversion made La Rose De Lisieux the first English language school in the district of Giza at that time, as well as it already being the oldest school to be established in the district if Giza.

La Rose De Lisieux is also extremely proud to have graduated numerous people who occupy high ranked positions nowadays in all sorts of fields. Moreover since taking over the educational institute under my supervision, the secondary graduating class percentage each year had always been 100 %, which makes all the hard work and effort pay off. However, I would not wish to give you the impression that we are just an examination factory. We pride ourselves on our family atmosphere. La Rose De Lisieux is a successful school which is currently experiencing a significant increase in pupil numbers. Academic results are strong, making the school one of the best in the Middle East.

Finally I would like to add that I was proudly chosen on behalf of the entire ministry to be the chairman of the private schools committee, due to the years of experience and hard work in the fields of education, where it finally today shows the great reputation of La Rose De Lisieux and it gives me pleasure and honor to pass on my experience and knowledge here today to both my daughter’s in the field of private educational management and leadership; Eng. Dr. Nivine Mohamed Abdel Moneim Metawy and Mrs. Sherine Mohamed Abdel Moneim Metawy.

Good luck and all the best to all…

Mohamed Abdel Moneim Metawy",
            'image' => '/storage/principal_messages/02.jpg',
        ]);
    }
}
