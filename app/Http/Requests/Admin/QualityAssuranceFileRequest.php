<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class QualityAssuranceFileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'title_ar' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'pdf' => 'nullable|mimes:pdf|max:10000',
        ];

        // Ensure title is required if needed, user said fields are there.
        // Usually titles are required? I'll make them nullable to be safe unless standard is required.
        // HowWeWelcomeChildRequest had nullable title?
        // Let's check Step 2103: 'title_ar' => 'nullable|string|max:255'.
        // So nullable is fine.

        // Image required on POST?
        if ($this->isMethod('post')) {
            // User put "image (uploaded)" so likely required.
            // But I'll make it nullable to avoid blocking if they want text only?
            // User said "image (upload)" specifically.
            // HowWeWelcomeChildRequest forced image on POST.
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif';
            // PDF? User said "pdf (upload)". nullable or required?
            // "Fields: ... pdf". I'll make it nullable.
        }

        return $rules;
    }
}
