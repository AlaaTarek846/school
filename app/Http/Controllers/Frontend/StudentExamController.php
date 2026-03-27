<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Exam;
use App\Models\Semester;
use App\Models\StudentExamAnswer;
use App\Models\StudentExamAnswerFile;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudentExamController extends Controller
{
    public function index()
    {
        $student = Auth::guard('student')->user();
        $enrollment = $student->currentEnrollment;

        if (!$enrollment) {
            return redirect()->route('student.dashboard')->with('error', 'No active enrollment found.');
        }

        $academicYears = AcademicYear::where('is_active', '=', 1)->latest()->get();
        $semesters = Semester::where('academic_year_id', '=', $enrollment->academic_year_id)->get();
        $subjects = $enrollment->educationStage->subjects;

        return view('student.exams.index', compact('student', 'academicYears', 'semesters', 'subjects', 'enrollment'));
    }

    public function getExams(Request $request)
    {
        $student = Auth::guard('student')->user();
        $classIds = $student->enrollments->pluck('school_class_id')->toArray();

        $query = Exam::whereHas('classes', function ($q) use ($classIds) {
            $q->whereIn('class_id', $classIds);
        })->with(['subject', 'academicYear', 'semester', 'studentAnswers' => function($q) use ($student) {
            $q->where('student_id', '=', $student->id)->with('files');
        }]);

        if ($request->filled('academic_year_id')) {
            $query->where('academic_year_id', $request->academic_year_id);
        }

        if ($request->filled('semester_id')) {
            $query->where('semester_id', $request->semester_id);
        }

        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('start_date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('start_date', '<=', $request->to_date);
        }

        $exams = $query->latest()->paginate(6);

        $now = Carbon::now();

        $exams->each(function ($exam) use ($now) {
            $exam->is_available = $now->between($exam->start_date, $exam->end_date);
            $exam->is_past = $now->greaterThan($exam->end_date);
            $exam->is_upcoming = $now->lessThan($exam->start_date);
        });

        return responseJson($exams->items(), '', 200, getPaginates($exams));
    }

    public function uploadAnswer(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'files' => 'required|array',
            'files.*' => 'required|file|mimes:pdf,doc,docx,jpg,png,jpeg|max:10240',
        ]);

        $student = Auth::guard('student')->user();
        $exam = Exam::findOrFail($request->exam_id);

        $now = Carbon::now();
        if (!$now->between($exam->start_date, $exam->end_date)) {
            return responseJson([], __('translation.Upload time has expired or not started yet'), 422);
        }

        $existingAnswer = StudentExamAnswer::where('student_id', $student->id)
            ->where('exam_id', $exam->id)
            ->first();

        if ($existingAnswer) {
            return responseJson([], __('translation.You have already submitted an answer for this exam'), 422);
        }

        $enrollment = $student->currentEnrollment;

        DB::beginTransaction();
        try {
            $answer = StudentExamAnswer::firstOrCreate(
                ['student_id' => $student->id, 'exam_id' => $exam->id],
                [
                    'class_id' => $enrollment->school_class_id,
                    'subject_id' => $exam->subject_id,
                    'education_stage_id' => $exam->education_stage_id,
                    'academic_year_id' => $exam->academic_year_id,
                    'semester_id' => $exam->semester_id,
                    'answer_score' => 0,
                    'is_passed' => 0
                ]
            );

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $path = $file->store('student_answers', 'public');
                    StudentExamAnswerFile::create([
                        'student_id' => $student->id,
                        'exam_id' => $exam->id,
                        'student_exam_answer_id' => $answer->id,
                        'pdf' => $path,
                    ]);
                }
            }

            DB::commit();
            return responseJson([], __('translation.Files uploaded successfully'), 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return responseJson([], __('translation.Something went wrong') . ' ' . $e->getMessage(), 500);
        }
    }

    public function results()
    {
        $student = Auth::guard('student')->user();
        $enrollment = $student->currentEnrollment;

        if (!$enrollment) {
            return redirect()->route('student.dashboard')->with('error', 'No active enrollment found.');
        }

        $academicYears = AcademicYear::where('is_active', 1)->latest()->get();
        $semesters = Semester::where('academic_year_id', $enrollment->academic_year_id)->get();
        $subjects = $enrollment->educationStage->subjects;

        return view('student.exams.results', compact('student', 'academicYears', 'semesters', 'subjects', 'enrollment'));
    }

    public function apiResults(Request $request)
    {
        $student = Auth::guard('student')->user();
        
        $query = StudentExamAnswer::where('student_id', $student->id)
            ->with(['exam' => function($q) {
                $q->with('subject', 'academicYear','semester');
            },'files']);

        if ($request->filled('academic_year_id')) {
            $query->where('academic_year_id', $request->academic_year_id);
        }

        if ($request->filled('semester_id')) {
            $query->where('semester_id', $request->semester_id);
        }

        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        $results = $query->latest()->paginate(10);

        return responseJson($results->items(), '', 200, getPaginates($results));
    }
}
