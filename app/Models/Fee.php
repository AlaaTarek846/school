<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'title_ar',
        'title_en',
        'note_ar',
        'note_en',
    ];

    public function details()
    {
        return $this->hasMany(FeeDetail::class);
    }
}
