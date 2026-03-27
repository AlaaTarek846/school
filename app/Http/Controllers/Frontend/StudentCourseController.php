<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\StudentEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentCourseController extends Controller
{
    public function index(Request $request)
    {
        $student = Auth::guard('student')->user();
        
        // Get all academic years the student has enrollments for
        $enrollments = StudentEnrollment::with('academicYear')
            ->where('student_id', $student->id)
            ->get();
            
        $academicYears = $enrollments->pluck('academicYear')->unique('id');
        
        // Get selected academic year or default to the current active one
        $selectedYearId = $request->get('academic_year_id');
        
        if (!$selectedYearId) {
            $defaultEnrollment = $enrollments->where('is_default', true)->first() ?: $enrollments->first();
            $selectedYearId = $defaultEnrollment ? $defaultEnrollment->academic_year_id : null;
        }
        
        // Get the enrollment for the selected year to identify the education stage
        $targetEnrollment = $enrollments->where('academic_year_id', $selectedYearId)->first();
        
        $subjects = collect();
        if ($targetEnrollment) {
            $subjects = Subject::where('education_stage_id', $targetEnrollment->education_stage_id)
                ->where('is_active', true)
                ->get();
        }
        
        return view('student.courses', compact('student', 'academicYears', 'subjects', 'selectedYearId'));
    }
}
