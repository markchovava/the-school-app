<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use App\Models\Subject\SubjectPrimary;
use Illuminate\Http\Request;

class SubjectPrimaryController extends Controller
{
    protected $school = 'Primary School';

    public function index(){
        $subjects = SubjectPrimary::orderBy('name', 'asc')->paginate(15);
        $data['subjects'] = $subjects;
        $data['school'] = $this->school;

        return view('backend.subject.primary.index', $data);
    }

    public function search(Request $request){
        $search = $request->search;
        $results = SubjectPrimary::where('name', 'LIKE', '%' . $search . '%')->orderBy('name', 'asc')->paginate(15);
        $data['results'] = $results;
        $data['school'] = $this->school;
        $data['search'] = $search;

        return view('backend.subject.primary.index', $data);
    }

    public function add(){
        $data['school'] = $this->school;
        return view('backend.subject.primary.add', $data);
    }

    public function store(Request $request){
        $subject = new SubjectPrimary();
        $subject->name = $request->name;
        $subject->save();

        return redirect()->route('admin.subject.primary');
    } 
    
    public function edit($id){
        $subject = SubjectPrimary::find($id);
        $data['subject'] = $subject;
        $data['school'] = $this->school;
        return view('backend.subject.primary.edit', $data);
    }

    public function update(Request $request, $id){
        $subject = SubjectPrimary::find($id);
        $subject->name = $request->name;
        $subject->save();

        return redirect()->route('admin.subject.primary');
    }

    public function view($id){
        $subject = SubjectPrimary::find($id);
        $data['subject'] = $subject;
        $data['school'] = $this->school;
        return view('backend.subject.primary.view', $data);
    }

    public function delete($id){
        $subject = SubjectPrimary::find($id);
        $subject->delete();

        return redirect()->route('admin.subject.primary');
    }
}
