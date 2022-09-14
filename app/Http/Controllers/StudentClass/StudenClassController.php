<?php

namespace App\Http\Controllers\StudentClass;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudenClassController extends Controller
{
    public function index(){
        return view('backend.student_class.index');
    }
}
