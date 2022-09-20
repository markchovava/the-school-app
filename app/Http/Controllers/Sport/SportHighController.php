<?php

namespace App\Http\Controllers\Sport;

use App\Http\Controllers\Controller;
use App\Models\Sport\SportHigh;
use Illuminate\Http\Request;

class SportHighController extends Controller
{
    
    protected $school = 'High School';

    public function index(){
        $sports = SportHigh::orderBy('name', 'asc')->paginate(15);
        $data['sports'] = $sports;
        $data['school'] = $this->school;

        return view('backend.sport.index', $data);
    }

    public function search(Request $request){
        $search = $request->search;
        $results = SportHigh::where('name', 'LIKE', '%' . $search . '%')->orderBy('name', 'asc')->paginate(15);
        $data['results'] = $results;
        $data['school'] = $this->school;
        $data['search'] = $search;

        return view('backend.sport.index', $data);
    }

    public function add(){
        $data['school'] = $this->school;
        return view('backend.sport.add', $data);
    }

    public function store(Request $request){
        $sport = new SportHigh();
        $sport->name = $request->name;
        $sport->save();

        return redirect()->route('admin.sport.high');
    } 
    
    public function edit($id){
        $sport = SportHigh::find($id);
        $data['sport'] = $sport;
        $data['school'] = $this->school;
        return view('backend.sport.edit', $data);
    }

    public function update(Request $request, $id){
        $sport = SportHigh::find($id);
        $sport->name = $request->name;
        $sport->save();

        return redirect()->route('admin.sport.high');
    }

    public function view($id){
        $sport = SportHigh::find($id);
        $data['sport'] = $sport;
        $data['school'] = $this->school;
        return view('backend.sport.view', $data);
    }

    public function delete($id){
        $sport = SportHigh::find($id);
        $sport->delete();

        return redirect()->route('admin.sport.high');
    } 
}
