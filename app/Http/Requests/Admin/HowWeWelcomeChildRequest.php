<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class HowWeWelcomeChildRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'title_ar' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        if ($this->isMethod('post')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        return $rules;
    }
}
