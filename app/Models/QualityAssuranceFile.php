<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QualityAssuranceFile extends Model
{
    use HasFactory, \App\Traits\TranslationsTrait;

    protected $fillable = [
        'title_ar',
        'title_en',
        'image',
        'pdf'
    ];
    //
}
