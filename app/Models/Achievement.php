<?php

namespace App\Models;

use App\Traits\SearchFilterTrait;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use SearchFilterTrait;
    protected $fillable = [
        'achievement_section_id',
        'icon',
        'text_ar',
        'text_en',
        'badge_icon',
    ];

    public function section()
    {
        return $this->belongsTo(AchievementSection::class, 'achievement_section_id');
    }

    public function getTextAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->text_ar : $this->text_en;
    }
}
