<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SchoolPride;
use Illuminate\View\View;

class SchoolPrideController extends Controller
{
    public function indexPage(): View
    {
        return view('admin.schoolPride.index');
    }

    public function index()
    {
        $prides = SchoolPride::all();
        return responseJson($prides, '', 200);
    }

    public function update(Request $request, SchoolPride $schoolPride)
    {
        $data = $request->validate([
            'image' => 'nullable',
            'overlay_icon' => 'nullable|string',
            'overlay_text_ar' => 'nullable|string',
            'overlay_text_en' => 'nullable|string',
            'icon' => 'nullable|string',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = saveFile($request->file('image'), 'schoolPride');
        } else {
            unset($data['image']);
        }

        $schoolPride->update($data);
        return responseJson([], 'Updated Successfully', 200);
    }
}
