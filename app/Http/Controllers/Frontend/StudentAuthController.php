<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\BaseController;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentAuthController extends BaseController
{
    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required',
            'password' => 'required',
        ]);

        $identifier = $request->identifier;
        $password = $request->password;

        // Try to find the student by username or code
        $student = Student::where('username', $identifier)
            ->orWhere('code', $identifier)
            ->first();

        if (!$student) {
            return back()->withErrors(['identifier' => __('translation.Invalid credentials')]);
        }

        // Standard password check
        if (Hash::check($password, $student->password)) {
            Auth::guard('student')->login($student, $request->has('remember'));
            return redirect()->route('student.dashboard');
        }

        // First-time login logic: if password matches student code
        if ($password == $student->code) {
            Auth::guard('student')->login($student, $request->has('remember'));
            return redirect()->route('student.dashboard');
        }

        return back()->withErrors(['password' => __('translation.Invalid credentials')]);
    }

    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect()->route('student-info');
    }

    public function showCompleteProfile()
    {
        $student = Auth::guard('student')->user();
        if ($student->is_completed) {
            return redirect()->route('student.dashboard');
        }

        return view('student.complete-profile', [
            'student' => $student,
            'layout' => $this->layout,
            'header' => $this->header,
            'footer' => $this->footer,
            'elements' => $this->elements,
            'partials' => $this->partials,
            'components' => $this->components,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $student = Auth::guard('student')->user();
        
        $request->validate([
            'username' => 'required|string|unique:students,username,' . $student->id,
            'password' => 'required|string|min:6|confirmed',
            'phone_1' => 'required|string',
            'phone_2' => 'nullable|string',
            'email' => 'nullable|email|unique:students,email,' . $student->id,
            'governorate' => 'nullable|string',
            'city' => 'nullable|string',
            'address' => 'nullable|string',
            'birth_day' => 'nullable|date',
        ]);
 
        $student->update([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'phone_1' => $request->phone_1,
            'phone_2' => $request->phone_2,
            'email' => $request->email,
            'governorate' => $request->governorate,
            'city' => $request->city,
            'address' => $request->address,
            'birth_day' => $request->birth_day,
            'is_completed' => true,
        ]);

        return redirect()->route('student.dashboard')->with('success', __('translation.Profile completed successfully'));
    }
}
