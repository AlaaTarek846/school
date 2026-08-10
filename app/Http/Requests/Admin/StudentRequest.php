<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $studentId = $this->route('student') ? $this->route('student')->id : null;

        return [
            'name' => 'required|string|max:255',
            'username' => ['nullable', 'string', 'max:255', Rule::unique('students', 'username')->ignore($studentId)],
            'code' => ['required', 'integer', Rule::unique('students', 'code')->ignore($studentId)],
            'email' => ['nullable', 'email', Rule::unique('students', 'email')->ignore($studentId)],
            'password' => $studentId ? 'nullable|min:8' : 'required|min:8',
            'phone_1' => 'nullable|string|max:20',
            'phone_2' => 'nullable|string|max:20',
            'gender' => 'required|in:male,female',
            'is_active' => 'required|boolean',
            'academic_year_id' => 'required|exists:academic_years,id',
            'semester_id' => 'required|exists:semesters,id',
            'education_stage_id' => 'required|exists:education_stages,id',
            'school_class_id' => 'required|exists:school_classes,id',
            'governorate' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'birth_day' => 'nullable|date',
            'is_completed' => 'required|boolean',
        ];
    }
}
