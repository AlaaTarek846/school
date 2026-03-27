<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AcademicYearRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'semesters' => 'required|array|min:1',
            'semesters.*.id' => 'nullable|exists:semesters,id',
            'semesters.*.title_ar' => 'required|string|max:255',
            'semesters.*.title_en' => 'required|string|max:255',
        ];
    }
}
