<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Health\Health;
use App\Models\Role\Role;
use App\Models\School\School;
use App\Models\Student\Student;
use App\Models\User;
use App\Models\User\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentHighController extends Controller
{
    protected $title = 'High School';

    /* List All Students in High School Only */
    public function index(){
        $school = School::where('name', 'LIKE', '%' . 'High' . '%')->first();
        $usertype = UserType::where('level', 1)->first();
        $students = User::with(['role', 'usertype'])
                    ->where('school_id', 'LIKE', '%' . $school->id . '%')
                    ->where('user_type_id', $usertype->id )
                    ->orderBy('name', 'ASC')->paginate(15);
        $data['students'] = $students;
        $data['title'] = $this->title;
        return view('backend.student.high.index', $data);
    }

    /* Search Students in High School Only */
    public function search(Request $request){
        $search = $request->search;
        $school = School::where('name', 'LIKE', '%' . 'High' . '%')->first();
        $results = User::with(['role', 'usertype', 'school'])
                        ->where('name', 'LIKE', '%' . $search . '%')
                        ->Where('school_id', 'LIKE', '%' . $school->id . '%')
                        ->orderBy('name', 'ASC')
                        ->paginate(15);
        $data['results'] = $results;
        $data['title'] = $this->title;
        return view('backend.student.high.index', $data);
    }

    public function add(){
        /* Student Role level is 4 */
        $role = Role::where('level', 4)->first();
        $data['role'] = $role;
        $usertype = UserType::where('level', 1)->first();
        $data['usertype'] = $usertype;
        $school = School::where('name', 'LIKE', '%' . 'High' . '%')->first();
        $data['school'] = $school;
        $data['title'] = $this->title;
        return view('backend.student.high.add', $data);
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

            /* Student */
            $student = new Student();
            $student->user_id =$user->id;
            $student->sponsor = $request->sponsor;
            $student->first_name = $request->sponsor_first_name;
            $student->last_name = $request->sponsor_last_name;
            $student->phone = $request->sponsor_phone;
            $student->email = $request->sponsor_email;
            $student->address = $request->sponsor_address;
            $student->occupation = $request->sponsor_occupation;
            $student->company_name = $request->sponsor_company_name;
            $student->save();
            /* Health Condition */
            $health = new Health();
            $health->user_id = $user->id;
            $health->allergy = $request->allergy;
            $health->illness = $request->illness;
            $health->save();

        });

        return redirect()->route('admin.student.high');
    }

    public function edit($id){
        $role = Role::where('level', 4)->first();
        $data['role'] = $role;
        $usertype = UserType::where('level', 1)->first();
        $data['usertype'] = $usertype;
        $school = School::where('name', 'LIKE', '%' . 'High' . '%')->first();
        $data['school'] = $school;
        /*  */
        $user = User::with(['role', 'usertype', 'school', 'health', 'student'])->find($id);
        $data['user'] = $user;
        $data['title'] = $this->title;
        return view('backend.student.high.edit', $data);
    }

    public function update(Request $request, $id){
        DB::transaction(function() use($request, $id){
            //$code = $this->randomString(8);
            /* User Info */
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
            $user->updated_at = now();
            //$user->code = $code;
            //$user->password = Hash::make($code);
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

            /* Student */
            $student = Student::where('user_id', $user->id)->first();
            $student->user_id =$user->id;
            $student->sponsor = $request->sponsor;
            $student->first_name = $request->sponsor_first_name;
            $student->last_name = $request->sponsor_last_name;
            $student->phone = $request->sponsor_phone;
            $student->email = $request->sponsor_email;
            $student->address = $request->sponsor_address;
            $student->occupation = $request->sponsor_occupation;
            $student->company_name = $request->sponsor_company_name;
            $student->save();
            /* Health Condition */
            $health = Health::where('user_id', $user->id)->first();
            $health->user_id = $user->id;
            $health->allergy = $request->allergy;
            $health->illness = $request->illness;
            $health->save();

        });

        return redirect()->route('admin.student.high');
    }

   public function view($id){
        $user = User::with(['role', 'usertype', 'school', 'health', 'student'])->find($id);
        $data['user'] = $user;
        $data['title'] = $data['school'] = $this->title;
        return view('backend.student.high.view', $data);
   }

   public function delete($id){
        $user = User::find($id);
        Student::where('user_id', $user->id)->delete();
        Health::where('user_id', $user->id)->delete();
        $user->delete();
        return redirect()->route('admin.student.high');
   }


   public function randomString($length) {
        $keys = array_merge(range(0,9), range('a', 'z'));
        $key = "";
        for($i=0; $i < $length; $i++) {
            $key .= $keys[mt_rand(0, count($keys) - 1)];
        }
        return $key;
    }

}
