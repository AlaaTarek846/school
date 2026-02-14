<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OneAboutRequest extends FormRequest
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
        return [
            "title_ar" => "required|string",
            "title_en" => "required|string",
            "description_ar" => "required|string",
            "description_en" => "required|string",
            "details" => "required|array",
            "details.*.title_ar" => "required|string|max:200",
            "details.*.title_en" => "required|string|max:200",
            "details.*.count" => "required|integer",
            "details.*.image" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            "details.*.old_image" => "nullable|string",
            'first_photo' => [$this->method() == "PUT" ? 'nullable':'required','image','mimes:jpeg,png,jpg,gif'],
        ];
    }
}
