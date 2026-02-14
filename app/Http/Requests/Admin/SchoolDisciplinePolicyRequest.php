<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SchoolDisciplinePolicyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'image_en' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ];

        if ($this->isMethod('post')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif';
            $rules['image_en'] = 'required|image|mimes:jpeg,png,jpg,gif';
        }

        return $rules;
    }
}
