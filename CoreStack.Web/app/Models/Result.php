<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
 
    protected $guarded = [];


    // =================== Relationship =====================
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Course(){
        return $this->belongsTo(Course::class);
    }


    public function results(){
    return $this->hasMany(Result::class, 'course_id');
    }

    
}
