<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationStage extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'title_ar',
        'title_en',
    ];

    public function getTitleAttribute(){
        $locale = app()->getLocale();
        $title = $locale == 'ar' ? $this->getRawOriginal('title_ar') : $this->getRawOriginal('title_en');
        return (string) ($title ?? '');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function schoolClasses()
    {
        return $this->hasMany(SchoolClass::class);
    }

    public function feeDetails()
    {
        return $this->hasMany(FeeDetail::class);
    }

    public function parentsMeetingDetails()
    {
        return $this->hasMany(ParentsMeetingDetail::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function enrollments()
    {
        return $this->hasMany(StudentEnrollment::class, 'education_stage_id');
    }

}
