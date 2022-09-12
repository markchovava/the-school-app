<?php

namespace App\Models\StudentClass;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',	'form_id', 'grade_id'
    ];
}
