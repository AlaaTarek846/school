<?php

namespace Database\Seeders\Home;

use App\Models\Faq;
use App\Models\Service;
use App\Models\File;
use App\Models\ServiceFaq;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
            $faqs = [
                [
                    'title_ar'       => "حلول تقنية المعلومات",
                    'title_en'       => "IT Solutions",
                    'slug_ar'       => "حلول-تقنية-المعلومات",
                    'slug_en'       => "it-solutions",
                    'description_en' => 'We provide innovative IT solutions tailored to your business needs, including system maintenance, software development, and technical support.',
                    'description_ar' => 'نقدم حلولاً مبتكرة في مجال تقنية المعلومات مصممة خصيصاً لتلبية احتياجات أعمالك، بما في ذلك صيانة الأنظمة، وتطوير البرمجيات، والدعم الفني.',
                    "quote_en"       => "Proactively envisioned multimedia based expertise and cross-media growth strategies. Seamlessly visualize quality intellectual capital without superior.", 
                    "quote_ar"       => "تصوّر استباقي للخبرات المعتمدة على الوسائط المتعددة واستراتيجيات النمو عبر الوسائط المختلفة. تصور سلس لرأس المال الفكري عالي الجودة دون الحاجة إلى تفوق خارجي.",
                    'sort'           => 1,
                    'files'          => [
                        [
                            'name'            => 'IT-olutions.png',
                            'mime_type'       => 'image/jpg',
                            'uploaded_by'     => 1,
                            'size'	          => 123,
                            'uploadable_type' => Service::class,
                            'identifier'      => 'image',
                            'url'             => '/storage/service/service-details-img-1.jpg'
                        ],
                        [
                            'name'            => 'IT-olutions.png',
                            'mime_type'       => 'image/jpg',
                            'uploaded_by'     => 1,
                            'size'	          => 123,
                            'uploadable_type' => Service::class,
                            'identifier'      => 'icon',
                            'url'             => '/website/images/icon/sliding-text-icon-2.png'
                        ],
                        [
                            'name'            => 'IT-Solutions.pdf',
                            'mime_type'       => 'application/pdf',
                            'uploaded_by'     => 1,
                            'size'	          => 123,
                            'uploadable_type' => Service::class,
                            'identifier'      => 'pdf',
                            'url'             => '/storage/service/IT-Solutions.pdf'
                        ]
                    ]
                ],
                [
                    'title_en'       => "Cyber Security",
                    'title_ar'       => "الأمن السيبراني",
                    'slug_ar'       => "الأمن-السيبراني",
                    'slug_en'       => "cyber-security",
                    'description_en' => 'Protect your digital assets with advanced cyber security solutions. We offer threat detection, data protection, and network defense to keep your systems safe and resilient.',
                    'description_ar' => 'احمِ أصولك الرقمية من خلال حلول متقدمة في الأمن السيبراني. نقدم خدمات كشف التهديدات، وحماية البيانات، وتأمين الشبكات لضمان سلامة أنظمتك واستمراريتها.',
                    "quote_en"       => "Proactively envisioned multimedia based expertise and cross-media growth strategies. Seamlessly visualize quality intellectual capital without superior.", 
                    "quote_ar"       => "تصوّر استباقي للخبرات المعتمدة على الوسائط المتعددة واستراتيجيات النمو عبر الوسائط المختلفة. تصور سلس لرأس المال الفكري عالي الجودة دون الحاجة إلى تفوق خارجي.",
                    'sort'           => 2,
                    'files'          => [
                        [
                            'name'            => 'Cyber-Security.png',
                            'mime_type'       => 'image/jpg',
                            'uploaded_by'     => 1,
                            'size'	          => 123,
                            'uploadable_type' => Service::class,
                            'identifier'      => 'image',
                            'url'       => '/storage/service/service-details-img-boxes-1-1.jpg'
                        ],
                        [
                            'name'            => 'IT-olutions.png',
                            'mime_type'       => 'image/jpg',
                            'uploaded_by'     => 1,
                            'size'	          => 123,
                            'uploadable_type' => Service::class,
                            'identifier'      => 'icon',
                            'url'             => '/website/images/icon/sliding-text-icon-1.png'
                        ],
                        [
                            'name'            => 'Cyber-Security.pdf',
                            'mime_type'       => 'application/pdf',
                            'uploaded_by'     => 1,
                            'size'	          => 123,
                            'uploadable_type' => Service::class,
                            'identifier'      => 'pdf',
                            'url'       => '/storage/service/Cyber-Security.pdf'
                        ]
                    ]
                ],
                [
                    'title_en'       => "Cloud Services",
                    'title_ar'       => "خدمات السحابة",
                    'slug_ar'       => "خدمات-السحابة",
                    'slug_en'       => "cloud-services",
                    'description_en' => 'Empower your business with scalable and secure cloud services. We offer cloud hosting, data /storage, backup solutions, and seamless migration to the cloud.',
                    'description_ar' => 'عزّز أعمالك من خلال خدمات سحابية قابلة للتوسع وآمنة. نقدم استضافة سحابية، تخزين بيانات، حلول نسخ احتياطي، وانتقال سلس إلى البيئة السحابية.',
                    "quote_en"       => "Proactively envisioned multimedia based expertise and cross-media growth strategies. Seamlessly visualize quality intellectual capital without superior.", 
                    "quote_ar"       => "تصوّر استباقي للخبرات المعتمدة على الوسائط المتعددة واستراتيجيات النمو عبر الوسائط المختلفة. تصور سلس لرأس المال الفكري عالي الجودة دون الحاجة إلى تفوق خارجي.",
                    'sort'           => 3,
                    'files'          => [
                        [
                            'name'            => 'Cloud-Services.png',
                            'mime_type'       => 'image/jpg',
                            'uploaded_by'     => 1,
                            'size'	          => 123,
                            'uploadable_type' => Service::class,
                            'identifier'      => 'image',
                            'url'       => '/storage/service/service-details-img-boxes-1-2.jpg'
                        ],
                        [
                            'name'            => 'IT-olutions.png',
                            'mime_type'       => 'image/jpg',
                            'uploaded_by'     => 1,
                            'size'	          => 123,
                            'uploadable_type' => Service::class,
                            'identifier'      => 'icon',
                            'url'             => '/website/images/icon/sliding-text-icon-3.png'
                        ],
                        [
                            'name'            => 'Cloud-Services.pdf',
                            'mime_type'       => 'application/pdf',
                            'uploaded_by'     => 1,
                            'size'	          => 123,
                            'uploadable_type' => Service::class,
                            'identifier'      => 'pdf',
                            'url'       => '/storage/service/Cloud-Services.pdf'
                        ]
                    ]
                ],
                [
                    'title_en'       => "UI/UX Design",
                    'title_ar'       => "تصميم واجهات وتجربة المستخدم",
                    'slug_en'       => "ui-ux-design",
                    'slug_ar'       => "تصميم-واجهات-وتجربة-المستخدم",
                    'description_en' => 'We craft intuitive and visually engaging UI/UX designs that enhance user satisfaction and drive interaction. From wireframes to final prototypes, we ensure every detail delivers a seamless experience.',
                    'description_ar' => 'نصمم واجهات استخدام جذابة وتجارب مستخدم سلسة تعزز رضا المستخدم وتزيد من التفاعل. من الرسوم التخطيطية إلى النماذج الأولية النهائية، نضمن أن كل تفصيل يقدم تجربة مثالية.',
                    "quote_en"       => "Proactively envisioned multimedia based expertise and cross-media growth strategies. Seamlessly visualize quality intellectual capital without superior.", 
                    "quote_ar"       => "تصوّر استباقي للخبرات المعتمدة على الوسائط المتعددة واستراتيجيات النمو عبر الوسائط المختلفة. تصور سلس لرأس المال الفكري عالي الجودة دون الحاجة إلى تفوق خارجي.",
                    'sort'           => 4,
                    'files'          => [
                        [
                            'name'            => 'UI-UX-Design.png',
                            'mime_type'       => 'image/jpg',
                            'uploaded_by'     => 1,
                            'size'	          => 123,
                            'uploadable_type' => Service::class,
                            'identifier'      => 'image',
                            'url'       => '/storage/service/services-2-1.jpg'
                        ],
                        [
                            'name'            => 'IT-olutions.png',
                            'mime_type'       => 'image/jpg',
                            'uploaded_by'     => 1,
                            'size'	          => 123,
                            'uploadable_type' => Service::class,
                            'identifier'      => 'icon',
                            'url'             => '/website/images/icon/sliding-text-icon-1.png'
                        ],
                        [
                            'name'            => 'UI-UX-Design.pdf',
                            'mime_type'       => 'application/pdf',
                            'uploaded_by'     => 1,
                            'size'	          => 123,
                            'uploadable_type' => Service::class,
                            'identifier'      => 'pdf',
                            'url'       => '/storage/service/UI-UX-Design.pdf'
                        ]
                    ]
                ],
                [

                    'title_en'       => "Digital Marketing",
                    'title_ar'       => "التسويق الرقمي",
                    'slug_en'       => "digital-marketing",
                    'slug_ar'       => "التسويق-الرقمي",
                    'description_en' => 'Boost your brand visibility and engagement with our digital marketing services. We specialize in SEO, social media campaigns, content creation, and targeted advertising to help you reach the right audience.',
                    'description_ar' => 'ضاعف تأثير علامتك التجارية من خلال حلولنا المتكاملة في التسويق الرقمي. من تحسين محركات البحث واستراتيجيات التواصل الاجتماعي إلى إنشاء محتوى جذاب وإعلانات موجهة بدقة، نساعدك على الوصول إلى الجمهور الأكثر أهمية.',
                    "quote_en"       => "Proactively envisioned multimedia based expertise and cross-media growth strategies. Seamlessly visualize quality intellectual capital without superior.", 
                    "quote_ar"       => "تصوّر استباقي للخبرات المعتمدة على الوسائط المتعددة واستراتيجيات النمو عبر الوسائط المختلفة. تصور سلس لرأس المال الفكري عالي الجودة دون الحاجة إلى تفوق خارجي.",     
                    'sort'           => 5,
                    'files'          => [
                        [
                            'name'            => 'Digital-Marketing.png',
                            'mime_type'       => 'image/jpg',
                            'uploaded_by'     => 1,
                            'size'	          => 123,
                            'uploadable_type' => Service::class,
                            'identifier'      => 'image',
                            'url'       => '/storage/service/services-2-2.jpg'
                        ],
                        [
                            'name'            => 'IT-olutions.png',
                            'mime_type'       => 'image/jpg',
                            'uploaded_by'     => 1,
                            'size'	          => 123,
                            'uploadable_type' => Service::class,
                            'identifier'      => 'icon',
                            'url'             => '/website/images/icon/sliding-text-icon-3.png'
                        ],
                        [
                            'name'            => 'Digital-Marketing.pdf',
                            'mime_type'       => 'application/pdf',
                            'uploaded_by'     => 1,
                            'size'	          => 123,
                            'uploadable_type' => Service::class,
                            'identifier'      => 'pdf',
                            'url'       => '/storage/service/Digital-Marketing.pdf'
                        ]
                    ]
                ],
                [
                    'title_en'       => "Data Analytics",
                    'title_ar'       => "تحليلات البيانات",
                    'slug_en'       => "data-analytics",
                    'slug_ar'       => "تحليلات-البيانات",
                    'description_en' => 'Unlock the power of your data with our advanced analytics solutions. We help you identify trends, optimize performance, and make data-driven decisions that fuel growth.',
                    'description_ar' => 'اكتشف قوة بياناتك من خلال حلولنا المتقدمة لتحليلات البيانات. نساعدك على تحديد الاتجاهات، وتحسين الأداء، واتخاذ قرارات مبنية على البيانات تدفع نحو النمو.',
                    "quote_en"       => "Proactively envisioned multimedia based expertise and cross-media growth strategies. Seamlessly visualize quality intellectual capital without superior.", 
                    "quote_ar"       => "تصوّر استباقي للخبرات المعتمدة على الوسائط المتعددة واستراتيجيات النمو عبر الوسائط المختلفة. تصور سلس لرأس المال الفكري عالي الجودة دون الحاجة إلى تفوق خارجي.",
                    'sort'           => 6,
                    'files'          => [
                        [
                            'name'            => 'Data-Analytics.png',
                            'mime_type'       => 'image/jpg',
                            'uploaded_by'     => 1,
                            'size'	          => 123,
                            'uploadable_type' => Service::class,
                            'identifier'      => 'image',
                            'url'       => '/storage/service/services-2-3.jpg'
                        ],
                        [
                            'name'            => 'IT-olutions.png',
                            'mime_type'       => 'image/jpg',
                            'uploaded_by'     => 1,
                            'size'	          => 123,
                            'uploadable_type' => Service::class,
                            'identifier'      => 'icon',
                            'url'             => '/website/images/icon/sliding-text-icon-1.png'
                        ],
                        [
                            'name'            => 'Data-Analytics.pdf',
                            'mime_type'       => 'application/pdf',
                            'uploaded_by'     => 1,
                            'size'	          => 123,
                            'uploadable_type' => Service::class,
                            'identifier'      => 'pdf',
                            'url'       => '/storage/service/Data-Analytics.pdf'
                        ]
                    ]
                ]
            ];

            $ServiceFaqs = [
                [
                    'title_ar'       => "كيف تستخدم Techzen؟",
                    'title_en'       => "How to use Techzen?",
                    'description_en' => 'Technology is at the forefront of innovation and progress, enabling us to tackle some of the world’s biggest challenges and improve the quality of life for people around the globe.',
                    'description_ar' => 'تعد التكنولوجيا في طليعة الابتكار والتقدم، مما يمكننا من مواجهة بعض أكبر تحديات العالم وتحسين جودة الحياة للناس في جميع أنحاء العالم.',
                    'sort' =>1
                ],
                [
                    'title_en'       => "How to soft launch your business?",
                    'title_ar'       => "كيف تطلق عملك تجريبياً؟",
                    'description_en' => 'Technology is at the forefront of innovation and progress, enabling us to tackle some of the world’s biggest challenges and improve the quality of life for people around the globe.',
                    'description_ar' => 'تعد التكنولوجيا في طليعة الابتكار والتقدم، مما يمكننا من مواجهة بعض أكبر تحديات العالم وتحسين جودة الحياة للناس في جميع أنحاء العالم.',
                    'sort' =>2
                ],
                [
                    'title_en'       => "How to turn visitors into contributors?",
                    'title_ar'       => "ما هي فوائد استخدام خدمات السحابة؟",
                    'description_en' => 'Technology is at the forefront of innovation and progress, enabling us to tackle some of the world’s biggest challenges and improve the quality of life for people around the globe.',
                    'description_ar' => 'تعد التكنولوجيا في طليعة الابتكار والتقدم، مما يمكننا من مواجهة بعض أكبر تحديات العالم وتحسين جودة الحياة للناس في جميع أنحاء العالم.',
                    'sort' =>3
                ]
                
            ];

            foreach ($faqs as $faq) {
                $model = Service::create([
                    'status'         => true,
                    'sort'           => $faq['sort'],
                    'title_en'       => $faq['title_en'],
                    'title_ar'       => $faq['title_ar'],
                    'description_en' => $faq['description_en'],
                    'description_ar' => $faq['description_ar'],
                    'quote_en'       => $faq['quote_en'],
                    'quote_ar'       => $faq['quote_ar'],
                    'slug_en'       => $faq['slug_en'],
                    'slug_ar'       => $faq['slug_ar'],

                ]);
                if (isset($faq['files']) && is_array($faq['files'])) {
                    foreach ($faq['files'] as $file) {
                        File::create([
                            'name'            => $file['name'],
                            'mime_type'       => $file['mime_type'],
                            'uploaded_by'     => $file['uploaded_by'],
                            'size'	          => $file['size'],
                            'uploadable_type' => $file['uploadable_type'],
                            'uploadable_id'   => $model->id,
                            'identifier'      => $file['identifier'],
                            'url'             => $file['url']
                        ]);
                    }
                }
                foreach ($ServiceFaqs as $ServiceFaq) {
                    ServiceFaq::create([
                        'title_en'       => $ServiceFaq['title_en'],
                        'title_ar'       => $ServiceFaq['title_ar'],
                        'description_en' => $ServiceFaq['description_en'],
                        'description_ar' => $ServiceFaq['description_ar'],
                        'status'         => true,
                        'service_id'     => $model->id,
                        'sort'           => $ServiceFaq['sort'],
                    ]);
                }
            

            }

    }
}