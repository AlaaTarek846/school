<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CampusTourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexPage()
    {
        return view('admin.campusTour.index');
    }

    public function index()
    {
        $data = \App\Models\CampusTour::latest()->paginate(10);
        return responseJson($data->items(), '', 200, getPaginates($data));
    }

    public function store(\App\Http\Requests\Admin\CampusTourRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = saveFile($request->image, 'campus_tour');
        }
        \App\Models\CampusTour::create($data);
        return responseJson([], 'Added Successfully', 200);
    }

    public function update(\App\Http\Requests\Admin\CampusTourRequest $request, $id)
    {
        $record = \App\Models\CampusTour::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($record->image) {
                unlink_image_by_path($record->image);
            }
            $data['image'] = saveFile($request->image, 'campus_tour');
        }

        $record->update($data);
        return responseJson([], 'Updated Successfully', 200);
    }

    public function destroy($id)
    {
        $record = \App\Models\CampusTour::findOrFail($id);
        if ($record->image) {
            unlink_image_by_path($record->image);
        }
        $record->delete();
        return responseJson([], 'Deleted Successfully', 200);
    }
}
