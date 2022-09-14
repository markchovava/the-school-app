<?php

namespace App\Http\Controllers\Club;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function index(){
        return view('backend.club.index');
    }
}
