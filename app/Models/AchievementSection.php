<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\SearchFilterTrait;

class AchievementSection extends Model
{
    use SearchFilterTrait;
    protected $fillable = [
        'title_ar',
        'title_en',
        'border_color',
        'background_color',
    ];

    public function getTitleAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->title_ar : $this->title_en;
    }

    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }
}
