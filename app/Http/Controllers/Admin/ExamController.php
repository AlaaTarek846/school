<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExamRequest;
use App\Models\AcademicYear;
use App\Models\EducationStage;
use App\Models\Exam;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ExamController extends Controller
{
    public function indexPage()
    {
        return view('admin.exams.index');
    }

    public function index(Request $request)
    {
        $query = Exam::with(['educationStage', 'subject', 'academicYear', 'semester', 'classes']);

        if ($request->filled('search')) {
            $query->where(static function($q) use ($request) {
                $q->where('title_ar', 'like', '%' . $request->search . '%')
                  ->orWhere('title_en', 'like', '%' . $request->search . '%');
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

        if ($request->filled('from_date')) {
            $query->whereDate('start_date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('end_date', '<=', $request->to_date);
        }

        $data = $query->latest()->paginate(10);
        return responseJson($data->items(), '', 200, getPaginates($data));
    }

    public function store(ExamRequest $request)
    {
        $data = $request->validated();
        
        DB::transaction(function () use ($data, $request) {
            foreach ($data['exams'] as $index => $examData) {
                $pdfPath = null;
                // Handle file upload correctly in a loop for batch
                if ($request->hasFile("exams.$index.pdf")) {
                    $pdfPath = $request->file("exams.$index.pdf")->store('exams', 'public');
                }

                $exam = Exam::create([
                    'title_ar' => $examData['title_ar'],
                    'title_en' => $examData['title_en'],
                    'academic_year_id' => $data['academic_year_id'],
                    'semester_id' => $data['semester_id'],
                    'education_stage_id' => $data['education_stage_id'],
                    'subject_id' => $examData['subject_id'],
                    'start_date' => $data['start_date'] ?? null,
                    'end_date' => $data['end_date'] ?? null,
                    'notes' => $examData['notes'] ?? null,
                    'pdf' => $pdfPath,
                ]);

                $exam->classes()->sync($data['class_ids']);
            }
        });

        return responseJson([], 'Added Successfully', 200);
    }

    public function update(ExamRequest $request, $id)
    {
        $exam = Exam::withCount('studentAnswers')->findOrFail($id);
        $data = $request->validated();

        if ($exam->student_answers_count > 0) {
            // Check if they are trying to change critical fields
            $examInfo = $data['exams'][0] ?? [];
            if ($data['education_stage_id'] != $exam->education_stage_id || 
                $examInfo['subject_id'] != $exam->subject_id ||
                $data['academic_year_id'] != $exam->academic_year_id) {
                return responseJson([], 'Cannot change core fields for an exam that already has student answers.', 422);
            }
        }

        DB::transaction(function () use ($exam, $data, $request) {
            $updateData = [
                'academic_year_id' => $data['academic_year_id'],
                'semester_id' => $data['semester_id'],
                'education_stage_id' => $data['education_stage_id'],
                'start_date' => $data['start_date'] ?? null,
                'end_date' => $data['end_date'] ?? null,
            ];

            // If updating individually, the 'exams' array in request might have only one item
            if (!empty($data['exams'])) {
                $examInfo = $data['exams'][0]; // Assume first one
                $updateData = array_merge($updateData, [
                    'title_ar' => $examInfo['title_ar'],
                    'title_en' => $examInfo['title_en'],
                    'subject_id' => $examInfo['subject_id'],
                    'notes' => $examInfo['notes'] ?? null,
                ]);

                if ($request->hasFile("exams.0.pdf")) {
                    if ($exam->pdf) {
                        Storage::disk('public')->delete($exam->pdf);
                    }
                    $updateData['pdf'] = $request->file("exams.0.pdf")->store('exams', 'public');
                }
            }

            $exam->update($updateData);
            $exam->classes()->sync($data['class_ids']);
        });

        return responseJson([], 'Updated Successfully', 200);
    }

    public function destroy($id)
    {
        $exam = Exam::withCount('studentAnswers')->findOrFail($id);
        
        if ($exam->student_answers_count > 0) {
            return responseJson([], 'Cannot delete exam. It has associated student answers.', 422);
        }

        if ($exam->pdf) {
            Storage::disk('public')->delete($exam->pdf);
        }
        $exam->delete();
        return responseJson([], 'Deleted Successfully', 200);
    }

    // Dependent Data Endpoints
    public function getSemesters($id)
    {
        $data = Semester::where('academic_year_id', $id)->where('is_active', 1)->get();
        return responseJson($data, '', 200);
    }

    public function getStageData($id)
    {
        $stage = EducationStage::with(['subjects', 'schoolClasses'])->findOrFail($id);
        return responseJson([
            'subjects' => $stage->subjects,
            'classes' => $stage->schoolClasses,
        ], '', 200);
    }

    public function getInitialData()
    {
        return responseJson([
            'academic_years' => AcademicYear::where('is_active', 1)->get(),
            'education_stages' => EducationStage::all(),
        ], '', 200);
    }
}
