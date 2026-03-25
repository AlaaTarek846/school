<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EducationStageRequest;
use App\Models\EducationStage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EducationStageController extends Controller
{
    public function indexPage()
    {
        return view('admin.educationStage.index');
    }

    public function index()
    {
        $data = EducationStage::with(['subjects', 'schoolClasses'])->latest()->paginate(10);
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

            // Simple approach: delete and recreate children for simplicity in this case
            // Or use more advanced sync logic if IDs are provided
            $record->subjects()->delete();
            if (!empty($data['subjects'])) {
                $record->subjects()->createMany($data['subjects']);
            }

            $record->schoolClasses()->delete();
            if (!empty($data['school_classes'])) {
                $record->schoolClasses()->createMany($data['school_classes']);
            }
        });

        return responseJson([], 'Updated Successfully', 200);
    }

    public function destroy($id)
    {
        $record = EducationStage::findOrFail($id);
        $record->delete();
        return responseJson([], 'Deleted Successfully', 200);
    }
}
