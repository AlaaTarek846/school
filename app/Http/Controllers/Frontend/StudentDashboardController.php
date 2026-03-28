<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AcademicYear;
use App\Models\Semester;
use App\Models\StudentExamAnswer;
use Illuminate\Support\Facades\DB;

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
        $query = StudentExamAnswer::where('student_exam_answers.student_id', $student->id);

        if ($request->filled('academic_year_id')) {
            $query->where('student_exam_answers.academic_year_id', $request->academic_year_id);
        }
        if ($request->filled('semester_id')) {
            $query->where('student_exam_answers.semester_id', $request->semester_id);
        }
        if ($request->filled('subject_id')) {
            $query->where('student_exam_answers.subject_id', $request->subject_id);
        }

        $totalExams = (clone $query)->count();
        $passedExams = (clone $query)->where('is_passed', 1)->count();
        $failedExams = (clone $query)->where('is_passed', 0)->count();
        
        $avgScore = (clone $query)->join('exams', 'student_exam_answers.exam_id', '=', 'exams.id')
            ->select(DB::raw('AVG((student_exam_answers.answer_score / exams.total_score) * 100) as average'))
            ->value('average') ?? 0;

        $recentResults = (clone $query)->with(['exam.subject', 'exam.academicYear', 'exam.semester'])
            ->latest()
            ->limit(5)
            ->get();

        return responseJson([
            'total_exams' => $totalExams,
            'passed_exams' => $passedExams,
            'failed_exams' => $failedExams,
            'average_score' => round($avgScore, 1),
            'recent_results' => $recentResults
        ], '', 200);
    }
}
