<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\EducationStage;
use App\Models\Semester;
use App\Models\StudentExamAnswer;
use App\Models\Subject;
use Illuminate\Http\Request;

class StudentExamAnswerController extends Controller
{
    public function indexPage()
    {
        return view('admin.exam_answers.index');
    }

    public function index(Request $request)
    {
        $query = StudentExamAnswer::with([
            'student',
            'exam' => function ($q) {
                return $q->with(['subject','academicYear','semester','educationStage']);
            },
            'educationStage',
            'schoolClass',
            'files'
        ]);

        if ($request->filled('search')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('code', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('academic_year_id')) {
            $query->where('academic_year_id', $request->academic_year_id);
        }

        if ($request->filled('semester_id')) {
            $query->where('semester_id', $request->semester_id);
        }

        if ($request->filled('education_stage_id')) {
            $query->where('education_stage_id', $request->education_stage_id);
        }

        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        $data = $query->latest()->paginate(10);

        return responseJson($data->items(), '', 200, getPaginates($data));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'answer_score' => 'required|numeric|min:0',
            'is_passed' => 'required|boolean',
        ]);

        $answer = StudentExamAnswer::with('exam')->findOrFail($id);

        if ($request->answer_score > $answer->exam->total_score) {
            return responseJson([], 'The score cannot exceed the exam total score (' . $answer->exam->total_score . ')', 422);
        }

        $answer->update([
            'answer_score' => $request->answer_score,
            'is_passed' => $request->is_passed,
            'is_completed' => 1,
        ]);

        return responseJson([], 'Successfully updated', 200);
    }

    public function getInitialData()
    {
        return responseJson([
            'academic_years' => AcademicYear::where('is_active', '=', 1)->get(),
            'education_stages' => EducationStage::all(),
        ], '', 200);
    }
}
