<?php

namespace App\Models;

use App\Traits\TranslationsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory, TranslationsTrait;

    protected $guarded = ['id'];


    public function getTitleAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->title_ar : $this->title_en;
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->description_ar : $this->description_en;
    }

     public function getSlugAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->slug_ar  : $this->slug_en;
    }

    public function getOverviewAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->overview_ar  : $this->overview_en;
    }
    public function getTagAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->tag_ar  : $this->tag_en;
    }



    public function media()
    {
        return $this->morphOne(File::class, 'uploadable');
    }

    public function image()
    {
        return $this->morphOne(File::class, 'uploadable')->where('identifier', 'image');
    }

    public function pdf()
    {
        return $this->morphOne(File::class, 'uploadable')->where('identifier', 'pdf');
    }

}