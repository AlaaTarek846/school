<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StudentRequest;
use App\Http\Resources\Admin\StudentResource;
use App\Models\Student;
use App\Models\AcademicYear;
use App\Models\Semester;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function indexPage(Request $request): View
    {
        return view('admin.students.index');
    }

    public function index(Request $request)
    {
        $students = Student::searchAndFilter()
        ->with(['currentEnrollment' => function ($q) {
            $q->with(['academicYear','semester','educationStage','schoolClass']);
        }])
        ->latest()
        ->paginate(50);

        return responseJson(StudentResource::collection($students->items()), '', 200, getPaginates($students));
    }

    public function getFormData()
    {
        $academicYears = AcademicYear::where('is_active', true)->get();
        $educationStages = \App\Models\EducationStage::all();

        return responseJson([
            'academicYears' => $academicYears,
            'educationStages' => $educationStages,
        ], '', 200);
    }

    public function getSemesters($academicYearId)
    {
        $semesters = Semester::where('academic_year_id', $academicYearId)->where('is_active', true)->get();
        return responseJson($semesters, '', 200);
    }

    public function getClasses($educationStageId)
    {
        $schoolClasses = SchoolClass::where('education_stage_id', $educationStageId)->where('is_active', true)->get();
        return responseJson($schoolClasses, '', 200);
    }

    public function store(StudentRequest $request)
    {
        try {
            DB::beginTransaction();

            $studentData = Arr::except($request->validated(), ['academic_year_id', 'semester_id', 'education_stage_id', 'school_class_id']);
            if (empty($studentData['username'])) {
                $studentData['username'] = 'std_' . $studentData['code'];
            }
            $studentData['password'] = bcrypt($request->password ?? '12345678');
            $student = Student::create($studentData);

            $student->enrollments()->create([
                'academic_year_id' => $request->academic_year_id,
                'semester_id' => $request->semester_id,
                'education_stage_id' => $request->education_stage_id,
                'school_class_id' => $request->school_class_id,
                'is_passed' => false,
                'total_score' => 0,
                'is_default' => true,
            ]);

            DB::commit();
            return responseJson([], __('admin.added_successfully'), 200);
        } catch (\Exception $e) {
            DB::rollback();
            return responseJson([], $e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        $student = Student::with(['currentEnrollment'])->find($id);

        $data = $student->toArray();
        $data['academic_year_id'] = $student->currentEnrollment?->academic_year_id;
        $data['semester_id'] = $student->currentEnrollment?->semester_id;
        $data['education_stage_id'] = $student->currentEnrollment?->education_stage_id;
        $data['school_class_id'] = $student->currentEnrollment?->school_class_id;

        return responseJson($data, 'Data fetched successfully', 200);
    }

    public function update(StudentRequest $request, Student $student)
    {
        try {
            DB::beginTransaction();

            $studentData = Arr::except($request->validated(), ['academic_year_id', 'semester_id', 'education_stage_id', 'school_class_id', 'password']);
            if ($request->filled('password')) {
                $studentData['password'] = bcrypt($request->password);
            }
            $student->update($studentData);

            if ($student->currentEnrollment) {
                $student->currentEnrollment->update([
                    'academic_year_id' => $request->academic_year_id,
                    'semester_id' => $request->semester_id,
                    'education_stage_id' => $request->education_stage_id,
                    'school_class_id' => $request->school_class_id,
                ]);
            } else {
                $student->enrollments()->create([
                    'academic_year_id' => $request->academic_year_id,
                    'semester_id' => $request->semester_id,
                    'education_stage_id' => $request->education_stage_id,
                    'school_class_id' => $request->school_class_id,
                    'is_passed' => false,
                    'total_score' => 0,
                    'is_default' => true,
                ]);
            }

            DB::commit();
            return responseJson([], __('admin.updated_successfully'), 200);
        } catch (\Exception $e) {
            DB::rollback();
            return responseJson([], $e->getMessage(), 500);
        }
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return responseJson(null, 'Student deleted successfully', 200);
    }

    public function updateScore(Request $request, Student $student)
    {
        $request->validate([
            'total_score' => 'required|numeric',
            'is_passed' => 'required|boolean',
        ]);

        $enrollment = $student->currentEnrollment;

        if (!$enrollment) {
            return responseJson(null, 'No default enrollment found for this student', 422);
        }

        $enrollment->update([
            'total_score' => $request->total_score,
            'is_passed' => $request->is_passed,
        ]);

        return responseJson(new StudentResource($student), 'Score updated successfully', 200);
    }
    public function exportTemplate()
    {
        return Excel::download(new \App\Exports\StudentsTemplateExport, 'students_import_template.xlsx');
    }

    public function validateImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            $import = new StudentsImport(true);
            Excel::import($import, $request->file('file'));
            $summary = $import->getValidationSummary();

            return responseJson($summary, 'Validation completed', 200);
        } catch (\Exception $e) {
            return responseJson([], $e->getMessage(), 500);
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            $import = new StudentsImport(false);
            Excel::import($import, $request->file('file'));
            $summary = $import->getValidationSummary();

            if ($summary['invalid_count'] > 0) {
                return responseJson($summary, __('admin.validation_error'), 422);
            }

            return responseJson($summary, __('admin.imported_successfully'), 200);
        } catch (\Exception $e) {
            return responseJson([], $e->getMessage(), 500);
        }
    }
    public function bulkUpdateScore(Request $request)
    {
        $request->validate([
            'students' => 'required|array',
            'students.*.id' => 'required|exists:students,id',
            'students.*.total_score' => 'required|numeric',
            'students.*.is_passed' => 'required|boolean',
        ]);

        try {
            DB::beginTransaction();

            foreach ($request->students as $studentData) {
                $student = Student::find($studentData['id']);
                $enrollment = $student->currentEnrollment;

                if ($enrollment) {
                    $enrollment->update([
                        'total_score' => $studentData['total_score'],
                        'is_passed' => $studentData['is_passed'],
                        'is_completed' => 1
                    ]);
                }
            }

            DB::commit();
            return responseJson([], __('admin.updated_successfully'), 200);
        } catch (\Exception $e) {
            DB::rollback();
            return responseJson([], $e->getMessage(), 500);
        }
    }
}
