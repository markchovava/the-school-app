<?php

namespace App\Http\Controllers\Sport;

use App\Http\Controllers\Controller;
use App\Models\Sport\Sport;
use Illuminate\Http\Request;

class SportController extends Controller
{
    public function index(){
        return view('backend.sport.index');
    }

    public function add(){
        return view('backend.sport.add');
    }

    public function store(Request $request){
        $sport = new Sport();
        $sport->name = $request->name;
        $sport->save();

        return redirect()->route('admin.sport');
    }
}
