<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        return view('backend.student.index');
    }

    public function add(){
        return view('backend.student.add');
    }
}
