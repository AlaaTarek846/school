<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EducationStageRequest;
use App\Models\EducationStage;
use Illuminate\Http\Request;

class EducationStageController extends Controller
{
    public function indexPage()
    {
        return view('admin.educationStage.index');
    }

    public function index()
    {
        $data = EducationStage::latest()->paginate(10);
        return responseJson($data->items(), '', 200, getPaginates($data));
    }

    public function store(EducationStageRequest $request)
    {
        $data = $request->validated();
        EducationStage::create($data);
        return responseJson([], 'Added Successfully', 200);
    }

    public function update(EducationStageRequest $request, $id)
    {
        $record = EducationStage::findOrFail($id);
        $data = $request->validated();
        $record->update($data);
        return responseJson([], 'Updated Successfully', 200);
    }

    public function destroy($id)
    {
        $record = EducationStage::findOrFail($id);
        $record->delete();
        return responseJson([], 'Deleted Successfully', 200);
    }
}
