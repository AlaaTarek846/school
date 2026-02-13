<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentRegistrationController extends Controller
{
    public function store(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'dob' => 'nullable|date',
            'phone' => ['required', 'string', 'regex:/^01[0125][0-9]{8}$/'],
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120', // 5MB max
        ], [
            'name.required' => __('The name field is required.'),
            'email.required' => __('The email field is required.'),
            'email.email' => __('Please enter a valid email address.'),
            'phone.required' => __('The phone field is required.'),
            'phone.regex' => __('Please enter a valid Egyptian phone number.'),
            'file.required' => __('Please upload the required file.'),
            'file.mimes' => __('The file must be of type: pdf, doc, docx, jpg, jpeg, png.'),
            'file.max' => __('The file may not be greater than 5MB.'),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()->all(),
            ], 422);
        }

        $data = $request->except('file');
        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('registrations', 'public');
        }

        \App\Models\StudentRegistration::create($data);

        return response()->json([
            'status' => 'success',
            'message' => __('Your registration has been submitted successfully!'),
        ]);
    }
}
