<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Role\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::orderBy('name', 'ASC')->paginate(15);
        $data['roles'] = $roles;

        $data['results'] = NULL;
        $data['search'] = NULL;

        return view('backend.role.index', $data);
    }

    public function search(Request $request){
        $search = $request->search;
        $results = Role::where('name', 'LIKE', '%' . $search . '%')->orderBy('name', 'ASC')->paginate(15);
        $data['results'] = $results;
        $data['roles'] = NULL;
        $data['search'] = $search;
        return view('backend.role.index', $data);
    }

    public function add(){
        return view('backend.role.add');
    }

    public function store(Request $request){
        $role = new Role();
        $role->level = $request->level;
        $role->name = $request->name;
        $role->save(); 

        return redirect()->route('admin.role');
    }

    public function view($id){
        $role = Role::find($id);
        $data['role'] = $role;
        return view('backend.role.view', $data);
    }

    public function edit($id){
        $role = Role::find($id);
        $data['role'] = $role;
        return view('backend.role.edit', $data);
    }

    public function update(Request $request, $id){
        $role = Role::find($id);
        $role->level = $request->level;
        $role->name = $request->name;
        $role->save(); 

        return redirect()->route('admin.role');
    }

    public function delete($id){
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('admin.role');
    }

}
