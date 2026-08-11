<?php

namespace App\Console\Commands;

use App\Models\Exam;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CleanVideoExamFiles extends Command
{
    protected $signature = 'exams:clean-video-files';

    protected $description = 'Delete video files from exams table records from storage';

    public function handle(): int
    {
        $videoExtensions = ['mp4', 'mpeg', 'avi', 'mov', 'webm', 'mkv'];

        $exams = Exam::whereNotNull('pdf')->get();
        $deleted = 0;

        foreach ($exams as $exam) {
            $extension = strtolower(pathinfo($exam->pdf, PATHINFO_EXTENSION));

            if (!in_array($extension, $videoExtensions)) {
                continue;
            }

            if (Storage::disk('public')->exists($exam->pdf)) {
                Storage::disk('public')->delete($exam->pdf);
                $deleted++;
            }

            $exam->update(['pdf' => null]);
            $this->info("Deleted video file for exam #{$exam->id}");
        }

        $this->info("Done. {$deleted} video file(s) deleted.");

        return self::SUCCESS;
    }
}