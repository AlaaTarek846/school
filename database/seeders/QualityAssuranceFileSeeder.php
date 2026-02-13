<?php

namespace Database\Seeders;

use App\Models\QualityAssuranceFile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QualityAssuranceFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        QualityAssuranceFile::query()->truncate();

        $data = [
            [
                'title_ar' => 'حقوق الطفل',
                'title_en' => 'Child Rights',
                'image' => '/storage/quality_assurance_files/logo_s1-1.png',
                'pdf' => '/storage/quality_assurance_files/driver_invoice_1002591.pdf',
            ],
            [
                'title_ar' => 'الرؤية و الرسالة 2021',
                'title_en' => 'Vision and Mission 2021',
                'image' => '/storage/quality_assurance_files/logo_s1-2.png',
                'pdf' => '/storage/quality_assurance_files/driver_invoice_1002592.pdf',
            ],
            [
                'title_ar' => 'الميثاق المهنى',
                'title_en' => 'Professional Charter',
                'image' => '/storage/quality_assurance_files/logo_s1-3.png',
                'pdf' => '/storage/quality_assurance_files/driver_invoice_1002593.pdf',
            ],
            [
                'title_ar' => 'جدول التوأمة الدولى والشعارات',
                'title_en' => 'International Twinning Schedule and Slogans',
                'image' => '/storage/quality_assurance_files/logo_s1-4.png',
                'pdf' => '/storage/quality_assurance_files/driver_invoice_1002594.pdf',
            ],
            [
                'title_ar' => 'جدول التوأمة الدولى  والشعارات',
                'title_en' => 'International Twinning Schedule and Slogans',
                'image' => '/storage/quality_assurance_files/logo_s1-5.png',
                'pdf' => '/storage/quality_assurance_files/driver_invoice_1002595.pdf',
            ],
            [
                'title_ar' => 'اللائحة التأدبيبة والجزاءات النموذجية',
                'title_en' => 'Disciplinary Regulations and Model Sanctions',
                'image' => '/storage/quality_assurance_files/logo_s1-6.png',
                'pdf' => '/storage/quality_assurance_files/driver_invoice_1002596.pdf',
            ],
            [
                'title_ar' => 'التشريعات و القوانين المنظمة لحقوق الطفل',
                'title_en' => 'Legislation and Laws Regulating Child Rights',
                'image' => '/storage/quality_assurance_files/logo_s1-7.png',
                'pdf' => '/storage/quality_assurance_files/driver_invoice_1002597.pdf',
            ],
        ];

        foreach ($data as $item) {
            QualityAssuranceFile::create($item);
        }
    }
}
