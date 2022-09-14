<?php

namespace App\Http\Controllers\Experience;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index(){
        return view('backend.experience.index');
    }
}
