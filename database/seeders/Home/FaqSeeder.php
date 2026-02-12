<?php

namespace Database\Seeders\Home;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $faqs = [
                [
                    'title_ar' => "What is the typical timeline for a construction project?",
                    'description_ar' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit ultrices neque sed, aliquam vivamus taciti est nullam auctor semper eget iaculis, lacus nascetur lectus penatibus aenean duis etiam aptent inceptos. Maecenas congue nisl blandit netus vehicula commodo sollicitudin, facilisi luctus eleifend ultrices sodales faucibus at.',
                    'title_en' => "What is the typical timeline for a construction project?",
                    'description_en' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit ultrices neque sed, aliquam vivamus taciti est nullam auctor semper eget iaculis, lacus nascetur lectus penatibus aenean duis etiam aptent inceptos. Maecenas congue nisl blandit netus vehicula commodo sollicitudin, facilisi luctus eleifend ultrices sodales faucibus at.'
                ],
                [
                    'title_ar' => "How can I ensure the safety of a construction site?",
                    'description_ar' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit ultrices neque sed, aliquam vivamus taciti est nullam auctor semper eget iaculis, lacus nascetur lectus penatibus aenean duis etiam aptent inceptos. Maecenas congue nisl blandit netus vehicula commodo sollicitudin, facilisi luctus eleifend ultrices sodales faucibus at.',
                    'title_en' => "How can I ensure the safety of a construction site?",
                    'description_en' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit ultrices neque sed, aliquam vivamus taciti est nullam auctor semper eget iaculis, lacus nascetur lectus penatibus aenean duis etiam aptent inceptos. Maecenas congue nisl blandit netus vehicula commodo sollicitudin, facilisi luctus eleifend ultrices sodales faucibus at.'
                ],
            ];

            foreach ($faqs as $faq) {
                $model = Faq::create([
                    'title_ar' => $faq['title_ar'],
                    'description_ar' => $faq['description_ar'],
                    'title_en' => $faq['title_en'],
                    'description_en' => $faq['description_en'],
                    'status' => true
                ]);
            }
        }
}