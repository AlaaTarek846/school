<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrincipalMessage extends Model
{
    use HasFactory, \App\Traits\TranslationsTrait;

    protected $fillable = [
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'image'
    ];
    //
}
