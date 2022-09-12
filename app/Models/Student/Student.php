<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'sponsor', 'phone_number', 'email',	
        'address', 'occupation', 'student_health_condition'
    ];
}
