<?php

namespace App\Models\StudentClass;

use App\Models\Form\Form;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassHigh extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'form_id'];

    /* One to One Belong To*/
    public function form(){
        return $this->belongsTo(Form::class, 'form_id', 'id');
    }
}
