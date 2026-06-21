<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    protected $guarded = [];


    // =================== Relationship =====================
    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Department(){
        return $this->belongsTo(Department::class);
    }  
}
