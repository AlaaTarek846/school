<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EducationStageRequest;
use App\Models\EducationStage;
use App\Models\Subject;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EducationStageController extends Controller
{
    public function indexPage()
    {
        return view('admin.educationStage.index');
    }

    public function index(Request $request)
    {
        $perPage = (int) $request->input('per_page', 10);
        $perPage = $perPage > 0 ? min($perPage, 500) : 10;

        $data = EducationStage::with(['subjects', 'schoolClasses'])
            ->orderBy('id')
            ->paginate($perPage);

        return responseJson($data->items(), '', 200, getPaginates($data));
    }

    public function store(EducationStageRequest $request)
    {
        $data = $request->validated();
        
        DB::transaction(function () use ($data) {
            $stage = EducationStage::create([
                'title_ar' => $data['title_ar'],
                'title_en' => $data['title_en'],
            ]);

            if (!empty($data['subjects'])) {
                $stage->subjects()->createMany($data['subjects']);
            }

            if (!empty($data['school_classes'])) {
                $stage->schoolClasses()->createMany($data['school_classes']);
            }
        });

        return responseJson([], 'Added Successfully', 200);
    }

    public function update(EducationStageRequest $request, $id)
    {
        $record = EducationStage::findOrFail($id);
        $data = $request->validated();

        DB::transaction(function () use ($record, $data) {
            $record->update([
                'title_ar' => $data['title_ar'],
                'title_en' => $data['title_en'],
            ]);

            // Smart sync subjects
            $existingSubjects = $record->subjects()->get();
            $incomingSubjectIds = collect($data['subjects'])->pluck('id')->filter()->toArray();

            foreach ($existingSubjects as $existingSubject) {
                if (!in_array($existingSubject->id, $incomingSubjectIds)) {
                    if (!$existingSubject->exams()->exists()) {
                        $existingSubject->delete();
                    }
                }
            }

            foreach ($data['subjects'] as $subjectData) {
                if (isset($subjectData['id'])) {
                    Subject::where('id', $subjectData['id'])->update([
                        'title_ar' => $subjectData['title_ar'],
                        'title_en' => $subjectData['title_en'],
                    ]);
                } else {
                    $record->subjects()->create($subjectData);
                }
            }

            // Smart sync classes
            $existingClasses = $record->schoolClasses()->get();
            $incomingClassIds = collect($data['school_classes'])->pluck('id')->filter()->toArray();

            foreach ($existingClasses as $existingClass) {
                if (!in_array($existingClass->id, $incomingClassIds)) {
                    if (!$existingClass->exams()->exists() && !$existingClass->enrollments()->exists()) {
                        $existingClass->delete();
                    }
                }
            }

            foreach ($data['school_classes'] as $classData) {
                if (isset($classData['id'])) {
                    SchoolClass::where('id', $classData['id'])->update([
                        'name' => $classData['name'],
                    ]);
                } else {
                    $record->schoolClasses()->create($classData);
                }
            }
        });

        return responseJson([], 'Updated Successfully', 200);
    }

    public function destroy($id)
    {
        $record = EducationStage::withCount(['exams', 'feeDetails'])->findOrFail($id);
        
        $hasReferencedSubjects = $record->subjects()->whereHas('exams')->exists();
        $hasReferencedClasses = $record->schoolClasses()->whereHas('exams')->orWhereHas('enrollments')->exists();

        if ($record->exams_count > 0 || $record->fee_details_count > 0 || $hasReferencedSubjects || $hasReferencedClasses) {
            return responseJson([], 'لا يمكن مسح هذه المرحلة لارتباطها ببيانات أخرى (امتحانات، مصروفات، أو طلاب)', 422);
        }

        DB::transaction(function () use ($record) {
            $record->subjects()->delete();
            $record->schoolClasses()->delete();
            $record->delete();
        });

        return responseJson([], 'Deleted Successfully', 200);
    }
}
