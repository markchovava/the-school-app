<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\School\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /* View All */
    public function index(){
        $schools = School::orderBy('name', 'ASC')->paginate(15);
        $data['schools'] = $schools;

        $data['results'] = NULL;
        $data['search'] = NULL;

        return view('backend.school.index', $data);
    }

    /* Display Search Results. */
    public function search(Request $request){
        $search = $request->search;
        $results = School::where('name', 'LIKE', '%' . $search . '%')->orderBy('name', 'ASC')->paginate(15);
        $data['results'] = $results;
        $data['schools'] = NULL;
        $data['search'] = $search;
        return view('backend.school.index', $data);
    }

    /* Add Page. */
    public function add(){
        return view('backend.school.add');
    }

    /* STore new Data */
    public function store(Request $request){
        $school = new School();
        $school->name = $request->name;
        $school->created_at = now();
        $school->save(); 

        return redirect()->route('admin.school');
    }

    /* View Single data entity */
    public function view($id){
        $school = School::find($id);
        $data['school'] = $school;
        return view('backend.school.view', $data);
    }

    /* Edit Page */
    public function edit($id){
        $school = School::find($id);
        $data['school'] = $school;
        return view('backend.school.edit', $data);
    }

    /* Update Data */
    public function update(Request $request, $id){
        $school = School::find($id);
        $school->updated_at = now();
        $school->name = $request->name;
        $school->save(); 

        return redirect()->route('admin.school');
    }

    /* Delete Data Entity */
    public function delete($id){
        $school = School::find($id);
        $school->delete();
        return redirect()->route('admin.school');
    }

}
