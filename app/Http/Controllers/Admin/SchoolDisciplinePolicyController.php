<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SchoolDisciplinePolicyRequest;
use App\Models\SchoolDisciplinePolicy;
use Illuminate\Http\Request;

class SchoolDisciplinePolicyController extends Controller
{
    public function indexPage()
    {
        return view('admin.schoolDisciplinePolicy.index');
    }

    public function index()
    {
        $data = SchoolDisciplinePolicy::latest()->paginate(10);
        return responseJson($data->items(), '', 200, getPaginates($data));
    }

    public function store(SchoolDisciplinePolicyRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = saveFile($request->image, 'school_discipline_policies');
        }
        if ($request->hasFile('image_en')) {
            $data['image_en'] = saveFile($request->image_en, 'school_discipline_policies');
        }
        SchoolDisciplinePolicy::create($data);
        return responseJson([], 'Added Successfully', 200);
    }

    public function update(SchoolDisciplinePolicyRequest $request, $id)
    {
        $record = SchoolDisciplinePolicy::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($record->image) {
                unlink_image_by_path($record->image);
            }
            $data['image'] = saveFile($request->image, 'school_discipline_policies');
        }

        if ($request->hasFile('image_en')) {
            if ($record->image_en) {
                unlink_image_by_path($record->image_en);
            }
            $data['image_en'] = saveFile($request->image_en, 'school_discipline_policies');
        }

        $record->update($data);
        return responseJson([], 'Updated Successfully', 200);
    }

    public function destroy($id)
    {
        $record = SchoolDisciplinePolicy::findOrFail($id);
        if ($record->image) {
            unlink_image_by_path($record->image);
        }
        if ($record->image_en) {
            unlink_image_by_path($record->image_en);
        }
        $record->delete();
        return responseJson([], 'Deleted Successfully', 200);
    }
}
