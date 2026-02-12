<?php

namespace App\Models;

use App\Traits\TranslationsTrait;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory, TranslationsTrait;

    protected $fillable = [
        'status',
        'sort',
        'title_en',
        'title_ar', 
        'description_en',
        'description_ar',
        'quote_ar',
        'quote_en',
        'slug_ar',
        'slug_en',
    ];

    public function media()
    {
        return $this->morphMany(File::class, 'uploadable');
    }



    public function image()
    {
        return $this->morphOne(File::class, 'uploadable')->where('identifier', 'image');
    }

    public function pdf()
    {
        return $this->morphOne(File::class, 'uploadable')->where('identifier', 'pdf');
    }

      public function icon()
    {
        return $this->morphOne(File::class, 'uploadable')->where('identifier', 'icon');
    }

    public function serviceFaqs()
    {
        return $this->hasMany(ServiceFaq::class);
    }

    public function getSlugAttribute(){
        return app()->getLocale() == 'ar' ? $this->slug_ar : $this->slug_en;
    }

}