<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'academic_year_id' => 'required|exists:academic_years,id',
            'semester_id' => 'required|exists:semesters,id',
            'education_stage_id' => 'required|exists:education_stages,id',
            'class_ids' => 'required|array',
            'class_ids.*' => 'exists:school_classes,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            
            'exams' => 'required|array|min:1',
            'exams.*.subject_id' => 'required|exists:subjects,id',
            'exams.*.title_ar' => 'required|string|max:255',
            'exams.*.title_en' => 'required|string|max:255',
            'exams.*.total_score' => 'required|integer|min:0',
            'exams.*.pass_score' => 'required|integer|min:0|lte:exams.*.total_score',
            'exams.*.notes' => 'nullable|string',
            'exams.*.pdf' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,png,jpg,jpeg,txt|max:10240', // 10MB
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            // Adjust for single update if needed, but the user requested batch add
            // If it's a single update, we might need a different request or logic.
            // For now, assume batch management or adjust accordingly.
        }

        return $rules;
    }
}
