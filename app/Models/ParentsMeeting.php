<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentsMeeting extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'title_ar',
        'title_en',
        'note_ar',
        'note_en',
        'is_general_time',
        'time_from',
        'time_to',
    ];

    protected $casts = [
        'is_general_time' => 'boolean',
    ];

    public function details()
    {
        return $this->hasMany(ParentsMeetingDetail::class);
    }
}
