<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentRegistrationController extends Controller
{
    public function indexPage(Request $request): \Illuminate\View\View
    {
        return view('admin.studentRegistration.index');
    }

    public function index(Request $request)
    {
        $studentRegistrations = \App\Models\StudentRegistration::paginate(10);
        return responseJson(\App\Http\Resources\Admin\StudentRegistrationResource::collection($studentRegistrations->items()), '', 200, getPaginates($studentRegistrations));
    }

    public function destroy(\App\Models\StudentRegistration $studentRegistration)
    {
        if ($studentRegistration->file_path) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($studentRegistration->file_path);
        }
        $studentRegistration->delete();
        return responseJson([], 'Deleted Successfully', 200);
    }
}
