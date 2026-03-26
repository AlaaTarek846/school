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
        $students = Student::with(['currentEnrollment.academicYear', 'currentEnrollment.semester', 'currentEnrollment.schoolClass'])
            ->latest()
            ->paginate(10);
            
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
        return responseJson([], __('admin.deleted_successfully'), 200);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new StudentsImport, $request->file('file'));
            return responseJson([], __('admin.imported_successfully'), 200);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errors = [];
            foreach ($failures as $failure) {
                $errors[] = __('admin.row') . ' ' . $failure->row() . ': ' . implode(', ', $failure->errors());
            }
            return responseJson(['errors' => $errors], __('admin.validation_error'), 422);
        } catch (\Exception $e) {
            return responseJson([], $e->getMessage(), 500);
        }
    }
}
