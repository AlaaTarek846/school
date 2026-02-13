<?php

namespace App\Models;

use App\Traits\TranslationsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyChooseUsDetail extends Model
{
    use HasFactory, TranslationsTrait;

    protected $guarded = [];

    protected $table = 'why_choose_us_details';

    public function whyChooseUs()
    {
        return $this->belongsTo(WhyChooseUs::class, 'why_choose_us_id');
    }

    public function getTitleAttribute($value)
    {
        return app()->getLocale() === 'ar' ? $this->title_ar : $this->title_en;
    }

    public function getDescriptionAttribute($value)
    {
        return app()->getLocale() === 'ar' ? $this->description_ar : $this->description_en;
    }
}
