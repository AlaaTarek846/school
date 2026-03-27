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

    public function getTitleAttribute(){
        $locale = app()->getLocale();
        $title = $locale == 'ar' ? $this->getRawOriginal('title_ar') : $this->getRawOriginal('title_en');
        return (string) ($title ?? '');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
