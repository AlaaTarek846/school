<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'title_ar',
        'title_en',
        'education_stage_id',
        'subject_id',
        'academic_year_id',
        'semester_id',
        'start_date',
        'end_date',
        'total_score',
        'pass_score',
        'notes',
        'is_active',
        'pdf',
    ];

    public function educationStage()
    {
        return $this->belongsTo(EducationStage::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function classes()
    {
        return $this->belongsToMany(SchoolClass::class, 'class_exam', 'exam_id', 'class_id');
    }

    public function studentAnswers()
    {
        return $this->hasMany(StudentExamAnswer::class);
    }
}
