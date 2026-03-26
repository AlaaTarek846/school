<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'title_ar',
        'title_en',
        'is_active',
        'education_stage_id',
    ];

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
