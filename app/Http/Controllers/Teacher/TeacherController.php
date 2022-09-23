<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Health\Health;
use App\Models\Role\Role;
use App\Models\School\School;
use App\Models\Teacher\Teacher;
use App\Models\User;
use App\Models\User\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    protected $title = 'Users';

    /* List All Students in High School Only */
    public function index(){
        $usertype = UserType::where('level', 2)->first(); // 2 is for Teacher
        $students = User::with(['role', 'usertype'])
                    ->where('user_type_id', $usertype->id)
                    ->orderBy('name', 'ASC')->paginate(15);
        $data['students'] = $students;
        $data['title'] = $this->title;
        return view('backend.teacher.index', $data);
    }

    /* Search Students in High School Only */
    public function search(Request $request){
        $search = $request->search;
        $usertype = UserType::where('level', 2)->first(); // 2 is for teacher
        $results = User::with(['role', 'usertype'])
                        ->where('name', 'LIKE', '%' . $search . '%')
                        ->where('user_type_id', $usertype->id)
                        ->orderBy('name', 'ASC')
                        ->paginate(15);
        $data['results'] = $results;
        $data['search'] = $search;
        $data['title'] = $this->title;
        return view('backend.teacher.index', $data);
    }

    public function add(){
        /* teacher Role level is 4 */
        $role = Role::where('level', 4)->first();
        $data['role'] = $role;
        $usertype = UserType::where('level', 2)->first();  // 1 is for Teacher
        $data['usertype'] = $usertype;
        $schools = School::orderBy('name', 'ASC')->get();
        $data['schools'] = $schools;
        $data['title'] = $this->title;
        return view('backend.teacher.add', $data);
    }

    public function store(Request $request){
        DB::transaction(function() use($request){
            $code = $this->randomString(8);
            /* User Info */
            $user = new User();
            $user->user_type_id = $request->user_type_id;
            $user->role_id = $request->role_id;
            $user->school_id = $request->school_id;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->name = $user->first_name . ' ' . $user->last_name;
            $user->date_of_birth = $request->day . ' ' . $request->month . ' ' . $request->year;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->address = $request->address;
            $user->nationality = $request->nationality;
            $user->id_number = $request->id_number;
            $user->code = $code;
            $user->password = Hash::make($code);
            $user->created_at = now();
            if( $request->file('image') ){
                $image = $request->file('image');
                $image_extension = strtolower($image->getClientOriginalExtension());
                $image_name = date('YmdHi'). '.' . $image_extension;
                $upload_location = 'storage/images/users/';
                if($user->image){
                    if(file_exists(public_path($upload_location . $user->image))){
                        unlink($upload_location . $user->image);
                    }
                    $image->move($upload_location, $image_name);
                    $user->image = $image_name;                    
                }else{
                    $image->move($upload_location, $image_name);
                    $user->image = $image_name;
                }              
            }
            $user->save();

            /* teacher */
            $teacher = new Teacher();
            $teacher->user_id =$user->id;
            $teacher->next_of_kin = $request->next_of_kin;
            $teacher->first_name = $request->kin_first_name;
            $teacher->last_name = $request->kin_last_name;
            $teacher->marital_status = $request->marital_status;
            $teacher->phone = $request->kin_phone;
            $teacher->email = $request->kin_email;
            $teacher->address = $request->kin_address;
            $teacher->occupation = $request->kin_occupation;
            $teacher->qualification = $request->qualification;
            $teacher->experience = $request->experience;
            $teacher->company_name = $request->kin_company_name;
            $teacher->save();
            /* Health Condition */
            $health = new Health();
            $health->user_id = $user->id;
            $health->allergy = $request->allergy;
            $health->illness = $request->illness;
            $health->save();

        });

        return redirect()->route('admin.teacher');
    }

    public function edit($id){
        $role = Role::where('level', 4)->first();
        $data['role'] = $role;
        $usertype = UserType::where('level', 2)->first(); // 1 is for Teacher
        $data['usertype'] = $usertype;
        $schools = School::orderBy('name', 'ASC')->get();
        $data['schools'] = $schools;
        /*  */
        $user = User::with(['role', 'usertype', 'school', 'health', 'teacher'])->find($id);
        $data['user'] = $user;
        $data['title'] = $this->title;
        return view('backend.teacher.edit', $data);
    }

    public function update(Request $request, $id){
        DB::transaction(function() use($request, $id){
            $user = User::find($id);
            $user->user_type_id = $request->user_type_id;
            $user->role_id = $request->role_id;
            $user->school_id = $request->school_id;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->name = $user->first_name . ' ' . $user->last_name;
            $user->date_of_birth = $request->day . ' ' . $request->month . ' ' . $request->year;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->address = $request->address;
            $user->nationality = $request->nationality;
            $user->id_number = $request->id_number;
            $user->created_at = now();
            if( $request->file('image') ){
                $image = $request->file('image');
                $image_extension = strtolower($image->getClientOriginalExtension());
                $image_name = date('YmdHi'). '.' . $image_extension;
                $upload_location = 'storage/images/users/';
                if($user->image){
                    if(file_exists(public_path($upload_location . $user->image))){
                        unlink($upload_location . $user->image);
                    }
                    $image->move($upload_location, $image_name);
                    $user->image = $image_name;                    
                }else{
                    $image->move($upload_location, $image_name);
                    $user->image = $image_name;
                }              
            }
            $user->save();

            /* teacher */
            $teacher = Teacher::where('user_id', $user->id)->first();
            $teacher->user_id =$user->id;
            $teacher->next_of_kin = $request->next_of_kin;
            $teacher->first_name = $request->kin_first_name;
            $teacher->last_name = $request->kin_last_name;
            $teacher->marital_status = $request->marital_status;
            $teacher->phone = $request->kin_phone;
            $teacher->email = $request->kin_email;
            $teacher->address = $request->kin_address;
            $teacher->occupation = $request->kin_occupation;
            $teacher->qualification = $request->qualification;
            $teacher->experience = $request->experience;
            $teacher->company_name = $request->kin_company_name;
            $teacher->save();
            /* Health Condition */
            $health = Health::where('user_id', $user->id)->first();
            $health->user_id = $user->id;
            $health->allergy = $request->allergy;
            $health->illness = $request->illness;
            $health->save();

        });

        return redirect()->route('admin.teacher');
    }

   public function view($id){
        $user = User::with(['role', 'usertype', 'school', 'health', 'teacher'])->find($id);
        $data['user'] = $user;
        $data['title'] = $data['school'] = $this->title;
        return view('backend.teacher.view', $data);
   }

   public function delete($id){
        $user = User::find($id);
        Teacher::where('user_id', $user->id)->delete();
        Health::where('user_id', $user->id)->delete();
        $user->delete();
        return redirect()->route('admin.teacher');
   }

   public function randomString($length){
        $keys = array_merge(range(0,9), range('a', 'z'), range('A', 'Z'));
        $key = "";
        for($i=0; $i < $length; $i++){
            $key .= $keys[mt_rand(0, count($keys) - 1)];
        }
        return $key;
    }


}
