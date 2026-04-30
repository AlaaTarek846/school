<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolPride extends Model
{
    protected $fillable = [
        'card_type',
        'image',
        'overlay_icon',
        'overlay_text_ar',
        'overlay_text_en',
        'icon',
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
    ];

    public function getTitleAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->title_ar : $this->title_en;
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->description_ar : $this->description_en;
    }

    public function getOverlayTextAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->overlay_text_ar : $this->overlay_text_en;
    }
}
