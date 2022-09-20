<?php

namespace App\Models\StudentClass;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassPrimary extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'grade_id'];
}
