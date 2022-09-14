<?php

namespace App\Models\Health;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Health extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'allergy', 'illness'
    ];
}
