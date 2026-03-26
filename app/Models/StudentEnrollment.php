<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentEnrollment extends Model
{
    protected $fillable = [
        'student_id',
        'academic_year_id',
        'semester_id',
        'school_class_id',
        'education_stage_id',
        'is_passed',
        'total_score',
        'is_default',
    ];

    protected function casts(): array
    {
        return [
            'is_passed' => 'boolean',
            'is_default' => 'boolean',
        ];
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }
}
