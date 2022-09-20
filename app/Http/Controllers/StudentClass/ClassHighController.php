<?php

namespace App\Http\Controllers\StudentClass;

use App\Http\Controllers\Controller;
use App\Models\StudentClass\ClassHigh;
use Illuminate\Http\Request;

class ClassHighController extends Controller
{
    protected $school = 'High School';

    public function index(){
        $student_classes = ClassHigh::orderBy('name', 'asc')->paginate(15);
        $data['student_classes'] = $student_classes;
        $data['school'] = $this->school;

        return view('backend.student_class.high.index', $data);
    }

    public function search(Request $request){
        $search = $request->search;
        $results = ClassHigh::where('name', 'LIKE', '%' . $search . '%')->orderBy('name', 'asc')->paginate(15);
        $data['results'] = $results;
        $data['school'] = $this->school;
        $data['search'] = $search;

        return view('backend.student_class.high.index', $data);
    }

    public function add(){
        $data['school'] = $this->school;
        return view('backend.student_class.high.add', $data);
    }

    public function store(Request $request){
        $student_class = new ClassHigh();
        $student_class->name = $request->name;
        $student_class->save();

        return redirect()->route('admin.student_class.high');
    } 
    
    public function edit($id){
        $student_class = ClassHigh::find($id);
        $data['student_class'] = $student_class;
        $data['school'] = $this->school;
        return view('backend.student_class.high.edit', $data);
    }

    public function update(Request $request, $id){
        $student_class = ClassHigh::find($id);
        $student_class->name = $request->name;
        $student_class->save();

        return redirect()->route('admin.student_class.high');
    }

    public function view($id){
        $student_class = ClassHigh::find($id);
        $data['student_class'] = $student_class;
        $data['school'] = $this->school;
        return view('backend.student_class.high.view', $data);
    }

    public function delete($id){
        $student_class = ClassHigh::find($id);
        $student_class->delete();

        return redirect()->route('admin.student_class.high');
    }
    
}
