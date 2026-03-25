<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationStage extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'title_ar',
        'title_en',
    ];

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function schoolClasses()
    {
        return $this->hasMany(SchoolClass::class);
    }

    public function feeDetails()
    {
        return $this->hasMany(FeeDetail::class);
    }
}
