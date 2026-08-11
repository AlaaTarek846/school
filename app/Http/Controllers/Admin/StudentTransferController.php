<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\EducationStage;
use App\Models\SchoolClass;
use App\Models\Semester;
use App\Models\Student;
use App\Models\StudentEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StudentTransferController extends Controller
{
    public function indexPage(): View
    {
        return view('admin.students.transfer');
    }

    public function getStudents(Request $request)
    {
        $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'education_stage_id' => 'required|exists:education_stages,id',
            'school_class_id' => 'nullable|exists:school_classes,id',
            'semester_id' => 'nullable|exists:semesters,id',
        ]);

        $query = Student::query()
            ->whereHas('enrollments', function ($q) use ($request) {
                $q->where('academic_year_id', $request->academic_year_id)
                  ->where('education_stage_id', $request->education_stage_id);
                
                if ($request->filled('school_class_id')) {
                    $q->where('school_class_id', $request->school_class_id);
                }

                if ($request->filled('semester_id')) {
                    $q->where('semester_id', $request->semester_id);
                }
            })
            ->with(['enrollments' => function ($q) use ($request) {
                $q->where('academic_year_id', $request->academic_year_id)
                  ->where('education_stage_id', $request->education_stage_id);

                if ($request->filled('school_class_id')) {
                    $q->where('school_class_id', $request->school_class_id);
                }
                  
                $q->with(['semester', 'schoolClass']);
            }]);

        $students = $query->get();

        $semestersInYear = Semester::where('academic_year_id', $request->academic_year_id)->get();

        $formattedStudents = $students->map(function ($student) use ($semestersInYear) {
            $enrollments = $student->enrollments;
            $semesterScores = [];
            $totalScore = 0;
            $finalStatusValue = null; // null = pending, false = failed, true = passed

            foreach ($semestersInYear as $sem) {
                $enrollment = $enrollments->where('semester_id', $sem->id)->first();
                $score = $enrollment ? $enrollment->total_score : 0;
                $status = $enrollment ? $enrollment->is_passed : false;
                $isCompleted = $enrollment ? (bool)$enrollment->is_completed : false;
                
                $semesterScores[] = [
                    'semester_id' => $sem->id,
                    'semester_title' => $sem->title,
                    'score' => $score,
                    'is_passed' => $status,
                    'is_completed' => $isCompleted,
                    'exists' => (bool)$enrollment,
                ];

                if ($enrollment && $isCompleted) {
                    $totalScore += $score;
                    $finalStatusValue = $status; 
                }
            }

            return [
                'id' => $student->id,
                'name' => $student->name,
                'code' => $student->code,
                'semester_scores' => $semesterScores,
                'total_score' => $totalScore,
                'final_status' => $finalStatusValue,
                'current_class' => $enrollments->first()?->schoolClass?->name ?? '-',
            ];
        });

        return responseJson([
            'students' => $formattedStudents,
            'semesters' => $semestersInYear,
        ], '', 200);
    }

    public function executeTransfer(Request $request)
    {
        $request->validate([
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:students,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'semester_id' => 'required|exists:semesters,id',
            'education_stage_id' => 'required|exists:education_stages,id',
            'school_class_id' => 'required|exists:school_classes,id',
        ]);

        try {
            DB::beginTransaction();

            foreach ($request->student_ids as $studentId) {
                // Set all previous enrollments to not default
                StudentEnrollment::where('student_id', $studentId)->update(['is_default' => false]);

                // Create or update the target enrollment
                StudentEnrollment::updateOrCreate(
                    [
                        'student_id' => $studentId,
                        'academic_year_id' => $request->academic_year_id,
                        'semester_id' => $request->semester_id,
                        'education_stage_id' => $request->education_stage_id,
                        'school_class_id' => $request->school_class_id,
                    ],
                    [
                        'is_default' => true,
                        'total_score' => 0,
                        'is_passed' => false,
                        'is_completed' => false,
                    ]
                );
            }

            DB::commit();
            return responseJson([], __('admin.transferred_successfully'), 200);
        } catch (\Exception $e) {
            DB::rollback();
            return responseJson([], $e->getMessage(), 500);
        }
    }

    public function deleteStudents(Request $request)
    {
        $request->validate([
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:students,id',
        ]);

        try {
            DB::beginTransaction();

            foreach ($request->student_ids as $studentId) {
                StudentEnrollment::where('student_id', $studentId)->delete();
            }

            Student::whereIn('id', $request->student_ids)->delete();

            DB::commit();
            return responseJson([], __('admin.deleted_successfully'), 200);
        } catch (\Exception $e) {
            DB::rollback();
            return responseJson([], $e->getMessage(), 500);
        }
    }
}
