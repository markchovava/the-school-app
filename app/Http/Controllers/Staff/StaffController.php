<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(){
        return view('backend.staff.index');
    }

    public function add(){
        return view('backend.staff.add');
    }
}
