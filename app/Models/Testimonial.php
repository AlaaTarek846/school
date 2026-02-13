<?php

namespace App\Models;

use App\Traits\TranslationsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar', 'job_ar', 'job_en', 'description_ar', 'description_en', 'status', 'rating'];

    protected $table = 'testimonials';

    public function media()
    {
        return $this->morphOne(File::class, 'uploadable');
    }



}
