<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = [
        'title_ar',
        'title_en',
        'is_active',
        'academic_year_id',
        'start_date',
        'end_date',
    ];

    public function getTitleAttribute(){
        $locale = app()->getLocale();
        $title = $locale == 'ar' ? $this->getRawOriginal('title_ar') : $this->getRawOriginal('title_en');
        return (string) ($title ?? '');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function enrollments()
    {
        return $this->hasMany(StudentEnrollment::class);
    }
}
