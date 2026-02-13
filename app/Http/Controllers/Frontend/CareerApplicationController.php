<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CareerApplicationController extends Controller
{
    public function store(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'dob' => 'nullable|date',
            'phone' => ['required', 'string', 'regex:/^01[0125][0-9]{8}$/'],
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB max
        ], [
            'name.required' => __('The name field is required.'),
            'email.required' => __('The email field is required.'),
            'email.email' => __('Please enter a valid email address.'),
            'phone.required' => __('The phone field is required.'),
            'phone.regex' => __('Please enter a valid Egyptian phone number.'),
            'cv.required' => __('Please upload your CV.'),
            'cv.mimes' => __('The CV must be a file of type: pdf, doc, docx.'),
            'cv.max' => __('The CV may not be greater than 5MB.'),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $data = $request->except('cv');
        if ($request->hasFile('cv')) {
            $data['cv_path'] = $request->file('cv')->store('cvs', 'public');
        }

        \App\Models\CareerApplication::create($data);

        return response()->json([
            'status' => 'success',
            'message' => __('Your application has been submitted successfully!')
        ]);
    }
}
