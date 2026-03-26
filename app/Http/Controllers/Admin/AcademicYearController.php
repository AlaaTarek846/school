<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AcademicYearRequest;
use App\Models\AcademicYear;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcademicYearController extends Controller
{
    public function indexPage()
    {
        return view('admin.academicYear.index');
    }

    public function index()
    {
        $data = AcademicYear::with(['semesters'])->latest()->paginate(10);
        return responseJson($data->items(), '', 200, getPaginates($data));
    }

    public function store(AcademicYearRequest $request)
    {
        $data = $request->validated();
        
        DB::transaction(function () use ($data) {
            $year = AcademicYear::create([
                'name' => $data['name'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
            ]);

            if (!empty($data['semesters'])) {
                $year->semesters()->createMany($data['semesters']);
            }
        });

        return responseJson([], 'Added Successfully', 200);
    }

    public function update(AcademicYearRequest $request, $id)
    {
        $record = AcademicYear::findOrFail($id);
        $data = $request->validated();

        DB::transaction(function () use ($record, $data) {
            $record->update([
                'name' => $data['name'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
            ]);

            // Smart sync semesters
            $existingSemesters = $record->semesters()->get();
            $incomingSemesterIds = collect($data['semesters'])->pluck('id')->filter()->toArray();

            foreach ($existingSemesters as $existingSemester) {
                if (!in_array($existingSemester->id, $incomingSemesterIds)) {
                    // Check if semester can be deleted
                    if (!$existingSemester->exams()->exists() && !$existingSemester->enrollments()->exists()) {
                        $existingSemester->delete();
                    }
                }
            }

            foreach ($data['semesters'] as $semesterData) {
                if (isset($semesterData['id'])) {
                    Semester::where('id', $semesterData['id'])->update([
                        'title_ar' => $semesterData['title_ar'],
                        'title_en' => $semesterData['title_en'],
                    ]);
                } else {
                    $record->semesters()->create($semesterData);
                }
            }
        });

        return responseJson([], 'Updated Successfully', 200);
    }

    public function destroy($id)
    {
        $record = AcademicYear::withCount(['exams', 'enrollments'])->findOrFail($id);
        
        // Check for direct references or references via semesters
        $hasReferencedSemesters = $record->semesters()->whereHas('exams')->orWhereHas('enrollments')->exists();

        if ($record->exams_count > 0 || $record->enrollments_count > 0 || $hasReferencedSemesters) {
            return responseJson([], 'لا يمكن مسح هذه السنة الدراسية لارتباطها ببيانات أخرى (امتحانات، طلاب، أو أقساط)', 422);
        }

        DB::transaction(function () use ($record) {
            $record->semesters()->delete();
            $record->delete();
        });

        return responseJson([], 'Deleted Successfully', 200);
    }
}
