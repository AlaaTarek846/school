<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentExamAnswerFile extends Model
{
    protected $fillable = [
        'student_id',
        'exam_id',
        'student_exam_answer_id',
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

    public function studentExamAnswer()
    {
        return $this->belongsTo(StudentExamAnswer::class);
    }
}
