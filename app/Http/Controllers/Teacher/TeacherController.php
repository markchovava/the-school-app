<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(){
        return view('backend.teacher.index');
    }

    public function add(){
        return view('backend.teacher.add');
    }
}
