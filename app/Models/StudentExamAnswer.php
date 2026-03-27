<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentExamAnswer extends Model
{
    protected $fillable = [
        'student_id',
        'exam_id',
        'class_id',
        'subject_id',
        'education_stage_id',
        'academic_year_id',
        'semester_id',
        'answer_score',
        'notes',
        'is_passed',
        'is_completed'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function files()
    {
        return $this->hasMany(StudentExamAnswerFile::class);
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function educationStage()
    {
        return $this->belongsTo(EducationStage::class, 'education_stage_id');
    }
}
