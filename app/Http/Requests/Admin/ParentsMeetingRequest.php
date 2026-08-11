<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ParentsMeetingRequest extends FormRequest
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
        $allowedDays = ['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday'];
        $isGeneral = filter_var($this->input('is_general_time'), FILTER_VALIDATE_BOOLEAN);

        $rules = [
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'note_ar' => 'nullable|string',
            'note_en' => 'nullable|string',
            'is_general_time' => 'required|boolean',
            'details' => 'required|array|min:1',
            'details.*.education_stage_id' => 'required|exists:education_stages,id',
            'details.*.days' => 'required|array|min:1',
            'details.*.days.*' => ['required', 'string', Rule::in($allowedDays)],
        ];

        if ($isGeneral) {
            $rules['time_from'] = 'required|date_format:H:i';
            $rules['time_to'] = 'required|date_format:H:i';
            $rules['details.*.time_from'] = 'nullable';
            $rules['details.*.time_to'] = 'nullable';
        } else {
            $rules['time_from'] = 'nullable';
            $rules['time_to'] = 'nullable';
            $rules['details.*.time_from'] = 'required|date_format:H:i';
            $rules['details.*.time_to'] = 'required|date_format:H:i';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'title_ar.required' => 'العنوان بالعربي مطلوب',
            'title_en.required' => 'العنوان بالإنجليزي مطلوب',
            'time_from.required' => 'وقت البداية مطلوب',
            'time_to.required' => 'وقت النهاية مطلوب',
            'time_from.date_format' => 'صيغة وقت البداية غير صحيحة',
            'time_to.date_format' => 'صيغة وقت النهاية غير صحيحة',
            'details.required' => 'أضف تفصيلة واحدة على الأقل',
            'details.*.education_stage_id.required' => 'المرحلة الدراسية مطلوبة',
            'details.*.education_stage_id.exists' => 'المرحلة الدراسية غير موجودة',
            'details.*.days.required' => 'اختر يوم واحد على الأقل',
            'details.*.time_from.required' => 'وقت البداية مطلوب لكل صف',
            'details.*.time_to.required' => 'وقت النهاية مطلوب لكل صف',
        ];
    }

    protected function prepareForValidation(): void
    {
        $normalize = function ($value) {
            if ($value === null || $value === '') {
                return null;
            }
            return substr((string) $value, 0, 5);
        };

        $details = collect($this->input('details', []))->map(function ($detail) use ($normalize) {
            $detail['education_stage_id'] = isset($detail['education_stage_id']) && $detail['education_stage_id'] !== ''
                ? (int) $detail['education_stage_id']
                : null;
            $detail['time_from'] = $normalize($detail['time_from'] ?? null);
            $detail['time_to'] = $normalize($detail['time_to'] ?? null);
            return $detail;
        })->all();

        $this->merge([
            'is_general_time' => filter_var($this->input('is_general_time'), FILTER_VALIDATE_BOOLEAN),
            'time_from' => $normalize($this->input('time_from')),
            'time_to' => $normalize($this->input('time_to')),
            'details' => $details,
        ]);
    }
}
