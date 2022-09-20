<?php

namespace App\Http\Controllers\Grade;

use App\Http\Controllers\Controller;
use App\Models\Grade\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    protected $school = 'Primary School';

    public function index(){
        $grades = Grade::orderBy('name', 'asc')->paginate(15);
        $data['grades'] = $grades;
        $data['school'] = $this->school;

        return view('backend.grade.index', $data);
    }

    public function search(Request $request){
        $search = $request->search;
        $results = Grade::where('name', 'LIKE', '%' . $search . '%')->orderBy('name', 'asc')->paginate(15);
        $data['results'] = $results;
        $data['school'] = $this->school;
        $data['search'] = $search;

        return view('backend.grade.index', $data);
    }

    public function add(){
        $data['school'] = $this->school;
        return view('backend.grade.add', $data);
    }

    public function store(Request $request){
        $grade = new Grade();
        $grade->name = $request->name;
        $grade->save();

        return redirect()->route('admin.grade');
    } 
    
    public function edit($id){
        $grade = Grade::find($id);
        $data['grade'] = $grade;
        $data['school'] = $this->school;
        return view('backend.grade.edit', $data);
    }

    public function update(Request $request, $id){
        $grade = Grade::find($id);
        $grade->name = $request->name;
        $grade->save();

        return redirect()->route('admin.grade');
    }

    public function view($id){
        $grade = Grade::find($id);
        $data['grade'] = $grade;
        $data['school'] = $this->school;
        return view('backend.grade.view', $data);
    }

    public function delete($id){
        $grade = Grade::find($id);
        $grade->delete();

        return redirect()->route('admin.grade');
    }
}
