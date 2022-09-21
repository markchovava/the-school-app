<?php

namespace App\Http\Controllers\StudentClass;

use App\Http\Controllers\Controller;
use App\Models\Grade\Grade;
use App\Models\StudentClass\ClassPrimary;
use Illuminate\Http\Request;

class ClassPrimaryController extends Controller
{
    protected $school = 'Primary School';

    public function index(){
        $student_classes = ClassPrimary::orderBy('name', 'asc')->paginate(15);
        $data['student_classes'] = $student_classes;
        $data['school'] = $this->school;

        return view('backend.student_class.primary.index', $data);
    }

    public function search(Request $request){
        $search = $request->search;
        $results = ClassPrimary::where('name', 'LIKE', '%' . $search . '%')->orderBy('name', 'asc')->paginate(15);
        $data['results'] = $results;
        $data['school'] = $this->school;
        $data['search'] = $search;

        return view('backend.student_class.primary.index', $data);
    }

    public function add(){
        $data['school'] = $this->school;
        $grades = Grade::orderBy('name', 'ASC')->get();
        $data['grades'] = $grades;
        return view('backend.student_class.primary.add', $data);
    }

    public function store(Request $request){
        $student_class = new ClassPrimary();
        $student_class->name = $request->name;
        $student_class->grade_id = $request->grade_id;
        $student_class->save();

        return redirect()->route('admin.student_class.primary');
    } 
    
    public function edit($id){
        $student_class = ClassPrimary::find($id);
        $data['student_class'] = $student_class;
        $data['school'] = $this->school;
        return view('backend.student_class.primary.edit', $data);
    }

    public function update(Request $request, $id){
        $student_class = ClassPrimary::find($id);
        $student_class->name = $request->name;
        $student_class->grade_id = $request->grade_id;
        $student_class->save();

        return redirect()->route('admin.student_class.primary');
    }

    public function view($id){
        $student_class = ClassPrimary::find($id);
        $data['student_class'] = $student_class;
        $data['school'] = $this->school;
        return view('backend.student_class.primary.view', $data);
    }

    public function delete($id){
        $student_class = ClassPrimary::find($id);
        $student_class->delete();

        return redirect()->route('admin.student_class.primary');
    }
}
