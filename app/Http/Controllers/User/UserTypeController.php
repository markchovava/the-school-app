<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\UserType;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    
    /* View All */
    public function index(){
        $usertypes = UserType::orderBy('name', 'ASC')->paginate(15);
        $data['usertypes'] = $usertypes;

        $data['results'] = NULL;
        $data['search'] = NULL;

        return view('backend.usertype.index', $data);
    }

    /* Display Search Results. */
    public function search(Request $request){
        $search = $request->search;
        $results = UserType::where('name', 'LIKE', '%' . $search . '%')->orderBy('name', 'ASC')->paginate(15);
        $data['results'] = $results;
        $data['usertypes'] = NULL;
        $data['search'] = $search;
        return view('backend.usertype.index', $data);
    }

    /* Add Page. */
    public function add(){
        return view('backend.usertype.add');
    }

    /* STore new Data */
    public function store(Request $request){
        $usertype = new UserType();
        $usertype->name = $request->name;
        $usertype->level = $request->level;
        $usertype->created_at = now();
        $usertype->save(); 

        return redirect()->route('admin.usertype');
    }

    /* View Single data entity */
    public function view($id){
        $usertype = UserType::find($id);
        $data['usertype'] = $usertype;
        return view('backend.usertype.view', $data);
    }

    /* Edit Page */
    public function edit($id){
        $usertype = UserType::find($id);
        $data['usertype'] = $usertype;
        return view('backend.usertype.edit', $data);
    }

    /* Update Data */
    public function update(Request $request, $id){
        $usertype = UserType::find($id);
        $usertype->updated_at = now();
        $usertype->name = $request->name;
        $usertype->level = $request->level;
        $usertype->save(); 

        return redirect()->route('admin.usertype');
    }

    /* Delete Data Entity */
    public function delete($id){
        $usertype = UserType::find($id);
        $usertype->delete();
        return redirect()->route('admin.usertype');
    }

    
}
