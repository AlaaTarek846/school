<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\EducationStage;
use App\Models\Exam;
use App\Models\SchoolClass;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ExamSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing exams to avoid duplicates and confusion
        Exam::query()->delete();

        $activeYears = AcademicYear::where('is_active', true)->get();
        if ($activeYears->isEmpty()) {
            $this->command->error('No Active Academic Year found. Please seed academic years first.');
            return;
        }

        $subjects = Subject::all();
        if ($subjects->isEmpty()) {
            $this->command->error('No Subjects found. Please seed subjects first.');
            return;
        }

        foreach ($activeYears as $academicYear) {
            $semester = Semester::where('academic_year_id', $academicYear->id)->first();
            if (!$semester) {
                continue;
            }

            foreach ($subjects as $subject) {
            // Get classes for the same education stage
            $classes = SchoolClass::where('education_stage_id', $subject->education_stage_id)->get();

            if ($classes->isEmpty()) {
                continue;
            }

            // Create 2 exams for each subject
            $examTypes = [
                ['en' => 'Midterm Exam - ' . $subject->title_en, 'ar' => 'امتحان منتصف الفصل - ' . $subject->title_ar, 'type' => 'midterm'],
                ['en' => 'Final Exam - ' . $subject->title_en, 'ar' => 'الامتحان النهائي - ' . $subject->title_ar, 'type' => 'final']
            ];

            foreach ($examTypes as $examData) {
                $exam = Exam::create([
                    'title_en' => $examData['en'],
                    'title_ar' => $examData['ar'],
                    'education_stage_id' => $subject->education_stage_id,
                    'subject_id' => $subject->id,
                    'academic_year_id' => $academicYear->id,
                    'semester_id' => $semester->id,
                    'start_date' => Carbon::now()->addDays(rand(1, 30)),
                    'end_date' => Carbon::now()->addDays(rand(31, 60)),
                    'total_score' => 100,
                    'pass_score' => 50,
                    'pdf' => 'exam/exam.pdf',
                    'is_active' => true,
                    'notes' => 'Seeded exam for ' . $subject->title_en,
                ]);

                // Link to all classes in this stage
                $exam->classes()->attach($classes->pluck('id'));
            }
        }
    }

    $this->command->info('ExamSeeder completed successfully.');
}
}
