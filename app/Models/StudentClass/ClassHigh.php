<?php

namespace App\Models\StudentClass;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassHigh extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'form_id'];
}
