<?php

namespace App\Http\Controllers\Club;

use App\Http\Controllers\Controller;
use App\Models\Club\ClubPrimary;
use Illuminate\Http\Request;

class ClubPrimaryController extends Controller
{
    protected $school = 'Primary School';

    public function index(){
        $clubs = ClubPrimary::orderBy('name', 'asc')->paginate(15);
        $data['clubs'] = $clubs;
        $data['school'] = $this->school;

        return view('backend.club.primary.index', $data);
    }

    public function search(Request $request){
        $search = $request->search;
        $results = ClubPrimary::where('name', 'LIKE', '%' . $search . '%')->orderBy('name', 'asc')->paginate(15);
        $data['results'] = $results;
        $data['school'] = $this->school;
        $data['search'] = $search;

        return view('backend.club.primary.index', $data);
    }

    public function add(){
        $data['school'] = $this->school;
        return view('backend.club.primary.add', $data);
    }

    public function store(Request $request){
        $club = new ClubPrimary();
        $club->name = $request->name;
        $club->description = $request->description;
        $club->save();

        return redirect()->route('admin.club.primary');
    } 
    
    public function edit($id){
        $club = ClubPrimary::find($id);
        $data['club'] = $club;
        $data['school'] = $this->school;
        return view('backend.club.primary.edit', $data);
    }

    public function update(Request $request, $id){
        $club = ClubPrimary::find($id);
        $club->name = $request->name;
        $club->description = $request->description;
        $club->save();

        return redirect()->route('admin.club.primary');
    }

    public function view($id){
        $club = ClubPrimary::find($id);
        $data['club'] = $club;
        $data['school'] = $this->school;
        return view('backend.club.primary.view', $data);
    }

    public function delete($id){
        $club = ClubPrimary::find($id);
        $club->delete();

        return redirect()->route('admin.club.primary');
    }
}
