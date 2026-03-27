<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\Semester;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class AcademicYearSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        AcademicYear::truncate();
        Semester::truncate();
        Schema::enableForeignKeyConstraints();

        $years = [
            ['name' => '2021-2022', 'start_date' => '2021-09-01', 'end_date' => '2022-06-30'],
            ['name' => '2022-2023', 'start_date' => '2022-09-01', 'end_date' => '2023-06-30'],
            ['name' => '2023-2024', 'start_date' => '2023-09-01', 'end_date' => '2024-06-30'],
            ['name' => '2024-2025', 'start_date' => '2024-09-01', 'end_date' => '2025-06-30'],
            ['name' => '2025-2026', 'start_date' => '2025-09-01', 'end_date' => '2026-06-30'],
        ];

        foreach ($years as $yearData) {
            $year = AcademicYear::create($yearData);

            $year->semesters()->createMany([
                [
                    'title_ar' => 'ترم اول',
                    'title_en' => 'Semester 1',
                    'start_date' => $yearData['start_date'],
                    'end_date' => date('Y-m-d', strtotime($yearData['start_date'] . ' +4 months')),
                    'is_active' => true,
                ],
                [
                    'title_ar' => 'ترم تاني',
                    'title_en' => 'Semester 2',
                    'start_date' => date('Y-m-d', strtotime($yearData['start_date'] . ' +5 months')),
                    'end_date' => $yearData['end_date'],
                    'is_active' => true,
                ]
            ]);
        }
    }
}
