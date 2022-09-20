<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use App\Models\Form\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /* View All */
    public function index(){
        $forms = Form::orderBy('name', 'ASC')->paginate(15);
        $data['forms'] = $forms;

        $data['results'] = NULL;
        $data['search'] = NULL;

        return view('backend.form.index', $data);
    }

    /* Display Search Results. */
    public function search(Request $request){
        $search = $request->search;
        $results = Form::where('name', 'LIKE', '%' . $search . '%')->orderBy('name', 'ASC')->paginate(15);
        $data['results'] = $results;
        $data['forms'] = NULL;
        $data['search'] = $search;
        return view('backend.form.index', $data);
    }

    /* Add Page. */
    public function add(){
        return view('backend.form.add');
    }

    /* STore new Data */
    public function store(Request $request){
        $form = new Form();
        $form->name = $request->name;
        $form->created_at = now();
        $form->save(); 

        return redirect()->route('admin.form');
    }

    /* View Single data entity */
    public function view($id){
        $form = Form::find($id);
        $data['form'] = $form;
        return view('backend.form.view', $data);
    }

    /* Edit Page */
    public function edit($id){
        $form = Form::find($id);
        $data['form'] = $form;
        return view('backend.form.edit', $data);
    }

    /* Update Data */
    public function update(Request $request, $id){
        $form = Form::find($id);
        $form->updated_at = now();
        $form->name = $request->name;
        $form->save(); 

        return redirect()->route('admin.form');
    }

    /* Delete Data Entity */
    public function delete($id){
        $form = Form::find($id);
        $form->delete();
        return redirect()->route('admin.form');
    }


}
