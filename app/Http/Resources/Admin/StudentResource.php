<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'code' => $this->code,
            'gender' => $this->gender,
            'is_active' => $this->is_active,
            'academic_year_id' => $this->currentEnrollment?->academic_year_id,
            'semester_id' => $this->currentEnrollment?->semester_id,
            'school_class_id' => $this->currentEnrollment?->school_class_id,
            'education_stage_id' => $this->currentEnrollment?->education_stage_id,
            'academic_year_name' => $this->currentEnrollment?->academicYear?->name,
            'semester_name' => $this->currentEnrollment?->semester?->name,
            'education_stage_name' => $this->currentEnrollment?->educationStage?->title,
            'school_class_name' => $this->currentEnrollment?->schoolClass?->name,
            'total_score' => $this->currentEnrollment?->total_score,
            'is_passed' => $this->currentEnrollment?->is_passed,
            'created_at' => $this->created_at?->format('Y-m-d'),
        ];
    }
}
