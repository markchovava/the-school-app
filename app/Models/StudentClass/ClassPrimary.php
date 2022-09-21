<?php

namespace App\Models\StudentClass;

use App\Models\Grade\Grade;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassPrimary extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'grade_id'];

    /* One to One Belong To*/
    public function grade(){
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }

}
