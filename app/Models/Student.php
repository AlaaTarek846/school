<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'username',
        'name',
        'password',
        'code',
        'email',
        'phone_1',
        'phone_2',
        'governorate',
        'city',
        'address',
        'gender',
        'birth_day',
        'is_active',
        'is_completed',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'birth_day' => 'date',
            'is_active' => 'boolean',
            'is_completed' => 'boolean',
        ];
    }

    public function enrollments()
    {
        return $this->hasMany(StudentEnrollment::class);
    }

    public function currentEnrollment()
    {
        return $this->hasOne(StudentEnrollment::class)->where('is_default', true);
    }
}
