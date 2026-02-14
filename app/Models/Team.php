<?php

namespace App\Models;

use App\Traits\TranslationsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\File;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory, TranslationsTrait;

    protected $guarded = [];
    protected $appends = ['name', 'job'];

    public function getNameAttribute($value)
    {
        return app()->getLocale() === 'ar' ? $this->name_ar : $this->name_en;
    }

    public function getJobAttribute($value)
    {
        return app()->getLocale() === 'ar' ? $this->job_ar : $this->job_en;
    }

    public function media()
    {
        return $this->morphOne(File::class, 'uploadable');
    }
}