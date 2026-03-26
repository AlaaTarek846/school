<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentExamAnswer extends Model
{
    protected $fillable = [
        'student_id',
        'exam_id',
        'answer_score',
        'notes',
        'is_passed',
        'pdf',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
