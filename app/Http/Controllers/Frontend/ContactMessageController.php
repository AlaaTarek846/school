<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactMessageController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => ['required', 'string', 'regex:/^01[0125][0-9]{8}$/'],
            'message' => 'required|string',
        ], [
            'name.required' => __('The name field is required.'),
            'email.required' => __('The email field is required.'),
            'email.email' => __('Please enter a valid email address.'),
            'phone.required' => __('The phone field is required.'),
            'phone.regex' => __('Please enter a valid Egyptian phone number.'),
            'message.required' => __('The message field is required.'),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        ContactMessage::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => __('Your message has been sent successfully!')
        ]);
    }
}
