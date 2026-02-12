<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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

            "title_ar"                   => "required|string|min:5|max:191|unique:projects,title_ar".($this->project?','.$this->project->id:''),
            "title_en"                   => "required|string|min:5|max:191|unique:projects,title_en".($this->project?','.$this->project->id:''),
            "description_ar"             => "required|string|min:5",
            "description_en"             => "required|string|min:5",
            "tag_en"                     => "nullable|string|min:5",
            "tag_ar"                     => "nullable|string|min:5",
            "overview_en"                => "nullable|string|min:5",
            "overview_ar"                => "nullable|string|min:5",
            "sort"                       => 'required|integer|unique:projects,sort'.($this->project?','.$this->project->id:''),
            'image' => [$this->method() == "PUT" ? 'nullable':'required','image','mimes:jpeg,png,jpg,gif','max:2048'],
            'pdf'                        => [$this->method() == "PUT" ? 'nullable':'nullable','file','mimes:pdf'],
            
        ];
    }
}
