<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'next_of_kin', 'marital_status', 
        'phone_number', 'email', 'address', 
        'occupation', 'teacher_health_condition'
    ];
}
