<?php

namespace App\Http\Controllers\Club;

use App\Http\Controllers\Controller;
use App\Models\Club\ClubHigh;
use Illuminate\Http\Request;

class ClubHighcontroller extends Controller
{
    
    protected $school = 'High School';

    public function index(){
        $clubs = ClubHigh::orderBy('name', 'asc')->paginate(15);
        $data['clubs'] = $clubs;
        $data['school'] = $this->school;

        return view('backend.club.high.index', $data);
    }

    public function search(Request $request){
        $search = $request->search;
        $results = ClubHigh::where('name', 'LIKE', '%' . $search . '%')->orderBy('name', 'asc')->paginate(15);
        $data['results'] = $results;
        $data['school'] = $this->school;
        $data['search'] = $search;

        return view('backend.club.high.index', $data);
    }

    public function add(){
        $data['school'] = $this->school;
        return view('backend.club.high.add', $data);
    }

    public function store(Request $request){
        $club = new ClubHigh();
        $club->name = $request->name;
        $club->description = $request->description;
        $club->save();

        return redirect()->route('admin.club.high');
    } 
    
    public function edit($id){
        $club = ClubHigh::find($id);
        $data['club'] = $club;
        $data['school'] = $this->school;
        return view('backend.club.high.edit', $data);
    }

    public function update(Request $request, $id){
        $club = ClubHigh::find($id);
        $club->name = $request->name;
        $club->description = $request->description;
        $club->save();

        return redirect()->route('admin.club.high');
    }

    public function view($id){
        $club = ClubHigh::find($id);
        $data['club'] = $club;
        $data['school'] = $this->school;
        return view('backend.club.view', $data);
    }

    public function delete($id){
        $club = ClubHigh::find($id);
        $club->delete();

        return redirect()->route('admin.club.high');
    }

}
