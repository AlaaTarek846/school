<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\StudentEnrollment;
use App\Models\AcademicYear;
use App\Models\Semester;
use App\Models\EducationStage;
use App\Models\SchoolClass;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class StudentSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        StudentEnrollment::truncate();
        Student::truncate();
        Schema::enableForeignKeyConstraints();

        $academicYears = AcademicYear::first();
        $semesters = Semester::all();
        $stages = EducationStage::all();
        $classes = SchoolClass::all();

        if (!$academicYears || $semesters->isEmpty() || $stages->isEmpty() || $classes->isEmpty()) {
            $this->command->error('Must have academic years, semesters, stages, and classes seeded first.');
            return;
        }

        Student::factory()
            ->count(100)
            ->create()
            ->each(function ($student) use ($academicYears, $semesters, $stages, $classes) {
                $stage = $stages->random();
                // Filter classes by stage if there's a relationship, assuming school_classes has education_stage_id
                $stageClasses = $classes->where('education_stage_id', $stage->id);
                $class = $stageClasses->isEmpty() ? $classes->random() : $stageClasses->random();

                $year = $academicYears;
                $yearSemesters = $semesters->where('academic_year_id', $year->id);

                $collection = $yearSemesters->isEmpty() ? collect($semesters) : collect($yearSemesters);
                $oddItems = $collection->filter(fn($item) => $item->id % 2 != 0);
                $semester = $oddItems->isNotEmpty()
                    ? $oddItems->random()
                    : null; // أو أي default value

                StudentEnrollment::create([
                    'student_id' => $student->id,
                    'academic_year_id' => $year->id,
                    'semester_id' => $semester->id,
                    'school_class_id' => $class->id,
                    'education_stage_id' => $stage->id,
                    'is_passed' => false,
                    'total_score' => 0,
                    'is_default' => true,
                ]);
            });
    }
}
