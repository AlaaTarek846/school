<?php

namespace App\Models;

use App\Traits\TranslationsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar', 'name_en', 'job_ar', 'job_en', 'description_ar', 'description_en', 'status', 'rating'];

    public function getNameAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->name_ar : ($this->name_en ?? $this->name_ar);
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->description_ar : ($this->description_en ?? $this->description_ar);
    }

    public function getJobAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->job_ar : ($this->job_en ?? $this->job_ar);
    }

    protected $table = 'testimonials';

    public function media()
    {
        return $this->morphOne(File::class, 'uploadable');
    }



}
