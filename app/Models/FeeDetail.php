<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeDetail extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'fee_id',
        'education_stage_id',
        'price',
    ];

    public function fee()
    {
        return $this->belongsTo(Fee::class);
    }

    public function educationStage()
    {
        return $this->belongsTo(EducationStage::class);
    }
}
