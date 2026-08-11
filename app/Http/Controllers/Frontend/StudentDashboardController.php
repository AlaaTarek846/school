<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AcademicYear;
use App\Models\Exam;
use App\Models\Semester;
use App\Models\StudentExamAnswer;
use Carbon\Carbon;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $student = Auth::guard('student')->user();
        $enrollment = $student->currentEnrollment;

        if (!$enrollment) {
            return redirect()->route('student.dashboard')->with('error', 'No active enrollment found.');
        }

        $academicYears = AcademicYear::where('is_active', 1)->latest()->get();
        $semesters = Semester::where('academic_year_id', $enrollment->academic_year_id)->get();
        $subjects = $enrollment->educationStage->subjects ?? [];

        return view('student.dashboard', compact('student', 'academicYears', 'semesters', 'subjects', 'enrollment'));
    }

    public function apiStatistics(Request $request)
    {
        $student = Auth::guard('student')->user();
        $classIds = $student->enrollments->pluck('school_class_id')->toArray();

        $query = Exam::whereHas('classes', function ($q) use ($classIds) {
            $q->whereIn('class_id', $classIds);
        });

        if ($request->filled('academic_year_id')) {
            $query->where('academic_year_id', $request->academic_year_id);
        }
        if ($request->filled('semester_id')) {
            $query->where('semester_id', $request->semester_id);
        }
        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        $totalExams = (clone $query)->count();

        $answeredExamIds = StudentExamAnswer::where('student_id', $student->id)
            ->whereIn('exam_id', (clone $query)->pluck('id'))
            ->pluck('exam_id')
            ->unique()
            ->toArray();

        $completedExams = count($answeredExamIds);
        $pendingExams = max(0, $totalExams - $completedExams);

        $now = Carbon::now();

        $recentExams = (clone $query)->with(['subject', 'academicYear', 'semester'])
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($exam) use ($answeredExamIds, $now) {
                return [
                    'id' => $exam->id,
                    'title_ar' => $exam->title_ar,
                    'title_en' => $exam->title_en,
                    'pdf' => $exam->pdf,
                    'start_date' => $exam->start_date,
                    'end_date' => $exam->end_date,
                    'is_completed' => in_array($exam->id, $answeredExamIds),
                    'is_available' => $now->between($exam->start_date, $exam->end_date),
                    'subject' => $exam->subject ? ['id' => $exam->subject->id, 'title_ar' => $exam->subject->title_ar] : null,
                    'academic_year' => $exam->academicYear ? ['id' => $exam->academicYear->id, 'name' => $exam->academicYear->name] : null,
                    'semester' => $exam->semester ? ['id' => $exam->semester->id, 'title_ar' => $exam->semester->title_ar] : null,
                ];
            });

        return responseJson([
            'total_exams' => $totalExams,
            'completed_exams' => $completedExams,
            'pending_exams' => $pendingExams,
            'completion_rate' => $totalExams > 0 ? round(($completedExams / $totalExams) * 100) : 0,
            'recent_assignments' => $recentExams,
        ], '', 200);
    }
}
