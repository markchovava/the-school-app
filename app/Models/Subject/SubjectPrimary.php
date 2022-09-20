<?php

namespace App\Models\Subject;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectPrimary extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    
}
