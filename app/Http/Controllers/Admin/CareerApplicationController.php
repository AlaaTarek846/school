<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CareerApplicationController extends Controller
{
    public function indexPage(Request $request): \Illuminate\View\View
    {
        return view('admin.careerApplication.index');
    }

    public function index(Request $request)
    {
        $careerApplications = \App\Models\CareerApplication::paginate(10);
        return responseJson(\App\Http\Resources\Admin\CareerApplicationResource::collection($careerApplications->items()), '', 200, getPaginates($careerApplications));
    }

    public function destroy(\App\Models\CareerApplication $careerApplication)
    {
        if ($careerApplication->cv_path) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($careerApplication->cv_path);
        }
        $careerApplication->delete();
        return responseJson([], 'Deleted Successfully', 200);
    }
}
