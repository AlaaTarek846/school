<?php

namespace App\Console\Commands;

use App\Models\AcademicYear;
use App\Models\Exam;
use App\Models\StudentExamAnswerFile;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ResetExamsAndCreateNewYear extends Command
{
    protected $signature = 'exams:reset-year';

    protected $description = 'Delete all exams with their files and create a new academic year row';

    public function handle(): int
    {
        // Delete exam files from storage
        $exams = Exam::whereNotNull('pdf')->get();
        foreach ($exams as $exam) {
            if (Storage::disk('public')->exists($exam->pdf)) {
                Storage::disk('public')->delete($exam->pdf);
            }
        }

        // Delete student answer files from storage
        $answerFiles = StudentExamAnswerFile::whereNotNull('pdf')->get();
        foreach ($answerFiles as $file) {
            if (Storage::disk('public')->exists($file->pdf)) {
                Storage::disk('public')->delete($file->pdf);
            }
        }

        // Delete all exams (answers & class_exam pivot cascade automatically)
        Exam::query()->delete();

        // Create new academic year row
        $now = Carbon::now();
        $yearStart = $now->year;

        $academicYear = AcademicYear::create([
            'name' => "{$yearStart}/" . ($yearStart + 1),
            'is_active' => true,
            'start_date' => $now->copy()->startOfYear()->addMonths(7)->toDateString(), // 1 Aug
            'end_date' => $now->copy()->startOfYear()->addMonths(19)->subDay()->toDateString(), // 31 Jul next year
        ]);

        $academicYear->semesters()->createMany([
            [
                'title_ar' => 'ترم اول',
                'title_en' => 'Semester 1',
                'start_date' => $academicYear['start_date'],
                'end_date' => date('Y-m-d', strtotime($academicYear['start_date'] . ' +4 months')),
                'is_active' => true,
            ],
            [
                'title_ar' => 'ترم تاني',
                'title_en' => 'Semester 2',
                'start_date' => date('Y-m-d', strtotime($academicYear['start_date'] . ' +5 months')),
                'end_date' => $academicYear['end_date'],
                'is_active' => true,
            ]
        ]);

        $this->info("All exams deleted with their files. Created academic year #{$academicYear->id}: {$academicYear->name}");

        return self::SUCCESS;
    }
}
