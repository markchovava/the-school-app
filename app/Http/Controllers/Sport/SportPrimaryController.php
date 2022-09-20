<?php

namespace App\Http\Controllers\Sport;

use App\Http\Controllers\Controller;
use App\Models\Sport\SportPrimary;
use Illuminate\Http\Request;

class SportPrimaryController extends Controller
{
    protected $school = 'Primary School';

    public function index(){
        $sports = SportPrimary::orderBy('name', 'asc')->paginate(15);
        $data['sports'] = $sports;
        $data['school'] = $this->school;

        return view('backend.sport.primary.index', $data);
    }

    public function search(Request $request){
        $search = $request->search;
        $results = SportPrimary::where('name', 'LIKE', '%' . $search . '%')->orderBy('name', 'asc')->paginate(15);
        $data['results'] = $results;
        $data['school'] = $this->school;
        $data['search'] = $search;

        return view('backend.sport.primary.index', $data);
    }

    public function add(){
        $data['school'] = $this->school;
        return view('backend.sport.primary.add', $data);
    }

    public function store(Request $request){
        $sport = new SportPrimary();
        $sport->name = $request->name;
        $sport->save();

        return redirect()->route('admin.sport.primary');
    } 
    
    public function edit($id){
        $sport = SportPrimary::find($id);
        $data['sport'] = $sport;
        $data['school'] = $this->school;
        return view('backend.sport.primary.edit', $data);
    }

    public function update(Request $request, $id){
        $sport = SportPrimary::find($id);
        $sport->name = $request->name;
        $sport->save();

        return redirect()->route('admin.sport.primary');
    }

    public function view($id){
        $sport = SportPrimary::find($id);
        $data['sport'] = $sport;
        $data['school'] = $this->school;
        return view('backend.sport.primary.view', $data);
    }

    public function delete($id){
        $sport = SportPrimary::find($id);
        $sport->delete();

        return redirect()->route('admin.sport.primary');
    }
}
