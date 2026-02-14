<?php

namespace Database\Seeders;

use App\Models\Fee;
use App\Models\FeeDetail;
use App\Models\EducationStage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure Education Stages exist
        if (EducationStage::count() === 0) {
            $this->call(EducationStageSeeder::class);
        }

        // Create the Fee record
        $fee = Fee::firstOrCreate(
            ['title_en' => 'Tuition Fees 2024 - 2025'],
            [
                'title_ar' => 'اجمالي المصروفات الدراسية للعام 2024 / 2025 ( بالتقريب)',
                'note_ar' => "* مواعيد دفع الرسوم الدراسية :\nالقسط الأول: 1 يوليو حتى نهاية سبتمبر.\nالقسط الثاني: 1 ديسمبر حتى نهاية يناير.",
                'note_en' => "* Tuition Payment Dates :\n1st Installment : 1st July till the end of September.\n2nd Installment : 1st of December till the end of January."
            ]
        );

        // Get all stages
        $stages = EducationStage::all();

        // Prepare Fee Details
        foreach ($stages as $stage) {
            FeeDetail::updateOrCreate(
                [
                    'fee_id' => $fee->id,
                    'education_stage_id' => $stage->id
                ],
                [
                    'price' => rand(15000, 20000)
                ]
            );
        }
    }
}
