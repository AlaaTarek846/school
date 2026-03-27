<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $fillable = [
        'name',
        'is_active',
        'education_stage_id',
    ];

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'class_exam', 'class_id', 'exam_id');
    }

    public function enrollments()
    {
        return $this->hasMany(StudentEnrollment::class, 'school_class_id');
    }
}
