<?php

namespace App\Models\Sport;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportPrimary extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
}
