<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use App\Models\Subject\SubjectHigh;
use Illuminate\Http\Request;

class SubjectHighController extends Controller
{
    protected $school = 'High School';

    public function index(){
        $subjects = SubjectHigh::orderBy('name', 'asc')->paginate(15);
        $data['subjects'] = $subjects;
        $data['school'] = $this->school;

        return view('backend.subject.high.index', $data);
    }

    public function search(Request $request){
        $search = $request->search;
        $results = SubjectHigh::where('name', 'LIKE', '%' . $search . '%')->orderBy('name', 'asc')->paginate(15);
        $data['results'] = $results;
        $data['school'] = $this->school;
        $data['search'] = $search;

        return view('backend.subject.high.index', $data);
    }

    public function add(){
        $data['school'] = $this->school;
        return view('backend.subject.high.add', $data);
    }

    public function store(Request $request){
        $subject = new SubjectHigh();
        $subject->name = $request->name;
        $subject->save();

        return redirect()->route('admin.subject.high');
    } 
    
    public function edit($id){
        $subject = SubjectHigh::find($id);
        $data['subject'] = $subject;
        $data['school'] = $this->school;
        return view('backend.subject.high.edit', $data);
    }

    public function update(Request $request, $id){
        $subject = SubjectHigh::find($id);
        $subject->name = $request->name;
        $subject->save();

        return redirect()->route('admin.subject.high');
    }

    public function view($id){
        $subject = SubjectHigh::find($id);
        $data['subject'] = $subject;
        $data['school'] = $this->school;
        return view('backend.subject.high.view', $data);
    }

    public function delete($id){
        $subject = SubjectHigh::find($id);
        $subject->delete();

        return redirect()->route('admin.subject.high');
    }
    
}
