<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Project;
use App\Models\ProjectChallengeSolution;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $section = Project::first();

        $faqs = [
            [
                "sort" => 1,
                "title_ar" => "ترميم السقف الكامل",
                "title_en" =>"Total Roof Restoration",
                "slug_ar" =>"ترميم-السقف-الكامل",
                "slug_en" =>"total-roof-restoration",
                "description_ar" =>"تآزر العلاقات الضريبية للموارد عبر الأسواق المتخصصة. زراعة خدمة العملاء من خلال أفكار قوية. تبسيط المقاييس المتمحورة حول المستخدم قبل الهياكل الرأسية. ابتكار منتجات مصنعة ممكّنة بينما المنصات الموازية.",
                "description_en" =>"Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically
                streamline user-centric metrics before vertical architectures. Objectively innovate empowered manufactured products whereas parallel platforms.",
                "overview_en" =>"Roofing is the process of installing repairing and maintaining roof",
                "overview_ar" =>"الأسقف هي عملية تركيب وإصلاح وصيانة السقف",
                "tag_en" => "United States",
                "tag_ar" => "الولايات المتحدة",
                "cost" => "150499",
                'media' => [
                    [
                        'name'            => 'portfolio-item-1',
                        'mime_type'       => 'image/jpg',
                        'uploaded_by'     => 1,
                        'size'	          => 123,
                        'uploadable_type' => Project::class,
                        'identifier'      => 'image',
                        'url'             => '/storage/project/project-page-1-3.jpg'
                    ]
                ]

            ],
            [
                "sort" => 2,
                   "title_ar" => "ترميم السقف الكامل",
                "title_en" =>"Total Roof Restoration",
                "slug_ar" =>"ترميم-السقف-الكامل",
                "slug_en" =>"total-roof-restoration",
                "description_ar" =>"تآزر العلاقات الضريبية للموارد عبر الأسواق المتخصصة. زراعة خدمة العملاء من خلال أفكار قوية. تبسيط المقاييس المتمحورة حول المستخدم قبل الهياكل الرأسية. ابتكار منتجات مصنعة ممكّنة بينما المنصات الموازية.",
                "description_en" =>"Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically
                streamline user-centric metrics before vertical architectures. Objectively innovate empowered manufactured products whereas parallel platforms.",
                "overview_en" =>"Roofing is the process of installing repairing and maintaining roof",
                "overview_ar" =>"الأسقف هي عملية تركيب وإصلاح وصيانة السقف",
                "tag_en" => "United States",
                "tag_ar" => "الولايات المتحدة",
                "cost" => "160499",
                'media' => [
                [
                    'name'            => 'portfolio-item-2',
                    'mime_type'       => 'image/jpg',
                    'uploaded_by'     => 1,
                    'size'	          => 123,
                    'uploadable_type' => Project::class,
                    'identifier'      => 'image',
                    'url'             => '/storage/project/project-page-1-4.jpg'
                    ]
                ]
            ],
            [
                "sort" => 3,
                 "title_ar" => "ترميم السقف الكامل",
                "title_en" =>"Total Roof Restoration",
                "slug_ar" =>"ترميم-السقف-الكامل",
                "slug_en" =>"total-roof-restoration",
                "description_ar" =>"تآزر العلاقات الضريبية للموارد عبر الأسواق المتخصصة. زراعة خدمة العملاء من خلال أفكار قوية. تبسيط المقاييس المتمحورة حول المستخدم قبل الهياكل الرأسية. ابتكار منتجات مصنعة ممكّنة بينما المنصات الموازية.",
                "description_en" =>"Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically
                streamline user-centric metrics before vertical architectures. Objectively innovate empowered manufactured products whereas parallel platforms.",
                "overview_en" =>"Roofing is the process of installing repairing and maintaining roof",
                "overview_ar" =>"الأسقف هي عملية تركيب وإصلاح وصيانة السقف",
                "tag_en" => "United States",
                "tag_ar" => "الولايات المتحدة",
                "cost" => "170499",
                'media' => [
                [
                    'name'            => 'portfolio-item-3',
                    'mime_type'       => 'image/jpg',
                    'uploaded_by'     => 1,
                    'size'	          => 123,
                    'uploadable_type' => Project::class,
                    'identifier'      => 'image',
                    'url'             => '/storage/project/project-page-1-5.jpg'
                    ]
                ]
            ],
            [
                "sort" => 4,
                "title_ar" => "ترميم السقف الكامل",
                "title_en" =>"Total Roof Restoration",
                "slug_ar" =>"ترميم-السقف-الكامل",
                "slug_en" =>"total-roof-restoration",
                "description_ar" =>"تآزر العلاقات الضريبية للموارد عبر الأسواق المتخصصة. زراعة خدمة العملاء من خلال أفكار قوية. تبسيط المقاييس المتمحورة حول المستخدم قبل الهياكل الرأسية. ابتكار منتجات مصنعة ممكّنة بينما المنصات الموازية.",
                "description_en" =>"Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically
                streamline user-centric metrics before vertical architectures. Objectively innovate empowered manufactured products whereas parallel platforms.",
                "overview_en" =>"Roofing is the process of installing repairing and maintaining roof",
                "overview_ar" =>"الأسقف هي عملية تركيب وإصلاح وصيانة السقف",
                "tag_en" => "United States",
                "tag_ar" => "الولايات المتحدة",
                "cost" => "180499",
                'media' => [
                [
                    'name'            => 'portfolio-item-4',
                    'mime_type'       => 'image/jpg',
                    'uploaded_by'     => 1,
                    'size'	          => 123,
                    'uploadable_type' => Project::class,
                    'identifier'      => 'image',
                    'url'             => '/storage/project/project-page-1-6.jpg'
                    ]
                ]
            ],
            [
                "sort" => 5,
                "title_ar" => "ترميم السقف الكامل",
                "title_en" =>"Total Roof Restoration",
                "slug_ar" =>"ترميم-السقف-الكامل",
                "slug_en" =>"total-roof-restoration",
                "description_ar" =>"تآزر العلاقات الضريبية للموارد عبر الأسواق المتخصصة. زراعة خدمة العملاء من خلال أفكار قوية. تبسيط المقاييس المتمحورة حول المستخدم قبل الهياكل الرأسية. ابتكار منتجات مصنعة ممكّنة بينما المنصات الموازية.",
                "description_en" =>"Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically
                streamline user-centric metrics before vertical architectures. Objectively innovate empowered manufactured products whereas parallel platforms.",
                "overview_en" =>"Roofing is the process of installing repairing and maintaining roof",
                "overview_ar" =>"الأسقف هي عملية تركيب وإصلاح وصيانة السقف",
                "tag_en" => "United States",
                "tag_ar" => "الولايات المتحدة",
                "cost" => "190499",
                'media' => [
                [
                    'name'            => 'portfolio-item-5',
                    'mime_type'       => 'image/jpg',
                    'uploaded_by'     => 1,
                    'size'	          => 123,
                    'uploadable_type' => Project::class,
                    'identifier'      => 'image',
                    'url'             => '/storage/project/project-page-1-7.jpg'
                    ]
                ]
            ],
            [
                "sort" => 6,
                "title_ar" => "ترميم السقف الكامل",
                "title_en" =>"Total Roof Restoration",
                "slug_ar" =>"ترميم-السقف-الكامل",
                "slug_en" =>"total-roof-restoration",
                "description_ar" =>"تآزر العلاقات الضريبية للموارد عبر الأسواق المتخصصة. زراعة خدمة العملاء من خلال أفكار قوية. تبسيط المقاييس المتمحورة حول المستخدم قبل الهياكل الرأسية. ابتكار منتجات مصنعة ممكّنة بينما المنصات الموازية.",
                "description_en" =>"Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically
                streamline user-centric metrics before vertical architectures. Objectively innovate empowered manufactured products whereas parallel platforms.",
                "overview_en" =>"Roofing is the process of installing repairing and maintaining roof",
                "overview_ar" =>"الأسقف هي عملية تركيب وإصلاح وصيانة السقف",
                "tag_en" => "United States",
                "tag_ar" => "الولايات المتحدة",
                "cost" => "151499",
                'media' => [
                    [
                    'name'            => 'portfolio-item-5',
                    'mime_type'       => 'image/jpg',
                    'uploaded_by'     => 1,
                    'size'	          => 123,
                    'uploadable_type' => Project::class,
                    'identifier'      => 'image',
                    'url'             => '/storage/project/project-page-1-8.jpg'
                    ]
                ]
            ],
        ];

        foreach ($faqs as $faq) {
            $model = Project::create([
                'title_ar' => $faq['title_ar'],
                'title_en' => $faq['title_en'],
                'slug_ar' => $faq['slug_ar'],
                'slug_en' => $faq['slug_en'],
                'description_ar' => $faq['description_ar'],
                'description_en' => $faq['description_en'],
                'overview_ar' => $faq['overview_ar'],
                'overview_en' => $faq['overview_en'],
                'tag_ar' => $faq['tag_ar'],
                'tag_en' => $faq['tag_en'],
                'cost' => $faq['cost'],
                "sort" => $faq['sort'],
            ]);
            if (isset($faq['media']) && is_array($faq['media'])) {
                foreach ($faq['media'] as $media) {
                    $model->media()->create($media);
                }
            }


        }
    }

}