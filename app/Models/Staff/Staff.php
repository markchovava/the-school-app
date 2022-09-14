<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'next_of_kin', 'marital_status', 
        'phone_number', 'email', 'address', 
        'occupation'
    ];
    
}
