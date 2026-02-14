<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class WhyChooseUsRequest extends FormRequest
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
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif",
            "details" => "required|array",
            "details.*.title_ar" => "required|string|max:200",
            "details.*.title_en" => "required|string|max:200",
            "details.*.description_ar" => "nullable|string",
            "details.*.description_en" => "nullable|string",

            "details.*.count" => "required|integer",
        ];
    }
}
