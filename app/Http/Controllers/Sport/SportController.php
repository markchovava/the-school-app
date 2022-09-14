<?php

namespace App\Http\Controllers\Sport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SportController extends Controller
{
    public function index(){
        return view('backend.sport.index');
    }
}
