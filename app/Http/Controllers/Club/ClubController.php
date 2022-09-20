<?php

namespace App\Http\Controllers\Club;

use App\Http\Controllers\Controller;
use App\Models\Club\Club;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function index(){
        return view('backend.club.index');
    }

    public function add(){
        return view('backend.club.add');
    }

    public function store(Request $request){
        $club = new Club();
        $club->name = $request->name;
        $club->description = $request->description;
        $club->save();

        return redirect()->route('admin.club');
    }
}
