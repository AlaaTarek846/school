<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentsMeetingDetail extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'parents_meeting_id',
        'education_stage_id',
        'school_class_id',
        'time_from',
        'time_to',
        'days',
    ];

    protected $casts = [
        'days' => 'array',
    ];

    public function parentsMeeting()
    {
        return $this->belongsTo(ParentsMeeting::class);
    }

    public function educationStage()
    {
        return $this->belongsTo(EducationStage::class);
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }
}
