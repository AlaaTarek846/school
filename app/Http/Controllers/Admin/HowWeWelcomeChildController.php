<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HowWeWelcomeChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexPage()
    {
        return view('admin.howWeWelcomeChild.index');
    }

    public function index()
    {
        $data = \App\Models\HowWeWelcomeChild::latest()->paginate(10);
        return responseJson($data->items(), '', 200, getPaginates($data));
    }

    public function store(\App\Http\Requests\Admin\HowWeWelcomeChildRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = saveFile($request->image, 'how_we_welcome_child');
        }
        \App\Models\HowWeWelcomeChild::create($data);
        return responseJson([], 'Added Successfully', 200);
    }

    public function update(\App\Http\Requests\Admin\HowWeWelcomeChildRequest $request, $id)
    {
        $record = \App\Models\HowWeWelcomeChild::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($record->image) {
                unlink_image_by_path($record->image);
            }
            $data['image'] = saveFile($request->image, 'how_we_welcome_child');
        }

        $record->update($data);
        return responseJson([], 'Updated Successfully', 200);
    }

    public function destroy($id)
    {
        $record = \App\Models\HowWeWelcomeChild::findOrFail($id);
        if ($record->image) {
            unlink_image_by_path($record->image);
        }
        $record->delete();
        return responseJson([], 'Deleted Successfully', 200);
    }
}
