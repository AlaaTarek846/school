<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\EducationStage;
use App\Models\Exam;
use App\Models\SchoolClass;
use App\Models\Service;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{

    public function index()
    {
        return view('admin.dashboard.dashboard');
    }

    public function getStats(): JsonResponse
    {
        // 1. Core Summary Metrics
        $totalStudents = Student::count();
        $activeStudents = Student::where('is_active', true)->count();
        $totalClasses = SchoolClass::count();
        $totalSubjects = Subject::count();
        $totalExams = Exam::count();

        // 2. Distributions
        // Ensure gender is normalized to lowercase for the chart
        $genderStats = Student::selectRaw('LOWER(gender) as gender_key, count(*) as count')
            ->whereNotNull('gender')
            ->groupBy('gender_key')
            ->get()
            ->map(fn($g) => [
                'gender' => $g->gender_key,
                'count' => $g->count
            ]);

        $stageStats = EducationStage::withCount(['enrollments' => function($query) {
                $query->distinct('student_id');
            }])
            ->get()
            ->map(fn($stage) => [
                'id' => $stage->id,
                'title' => $stage->title, // Using the Title Accessor
                'count' => $stage->enrollments_count
            ]);

        // 3. Content Stats (Safe check for table existence)
        $articleCount = Schema::hasTable('articles') ? Article::count() : 0;
        $serviceCount = Schema::hasTable('services') ? Service::count() : 0;

        // 4. Latest Activity
        $latestStudents = Student::with(['currentEnrollment.schoolClass'])
            ->latest()
            ->take(5)
            ->get()
            ->map(fn($s) => [
                'id' => $s->id,
                'name' => $s->name,
                'code' => $s->code,
                // Fallback to latest enrollment if is_default is not set
                'class' => ($s->currentEnrollment?->schoolClass?->name) 
                            ?? ($s->enrollments()->latest()->first()?->schoolClass?->name) 
                            ?? '-',
                'date' => $s->created_at->format('Y-m-d')
            ]);

        return response()->json([
            'success' => true,
            'data' => [
                'summary' => [
                    'total_students' => $totalStudents,
                    'active_students' => $activeStudents,
                    'total_classes' => $totalClasses,
                    'total_subjects' => $totalSubjects,
                    'total_exams' => $totalExams,
                ],
                'distributions' => [
                    'gender' => $genderStats,
                    'stages' => $stageStats,
                ],
                'content' => [
                    'articles' => $articleCount,
                    'services' => $serviceCount,
                ],
                'latest' => [
                    'students' => $latestStudents,
                ]
            ]
        ]);
    }


}
