<?php

namespace App\Models\Club;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubPrimary extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',	'description'
    ];
    
}
