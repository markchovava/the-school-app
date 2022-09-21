<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Health\Health;
use App\Models\Role\Role;
use App\Models\Student\Student;
use App\Models\User;
use App\Models\User\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index(){
        $students = User::with(['role', 'usertype'])->orderBy('name', 'ASC')->paginate(15);
        $data['students'] = $students;
        return view('backend.student.index', $data);
    }

    public function add(){
        /* Student Role level is 4 */
        $role = Role::where('level', 'LIKE', 4)->first();
        $data['role'] = $role;
        $usertype = UserType::where('name', 'LIKE', '%' . 'Primary' . '%')->first();
        $data['usertype'] = $usertype;
        return view('backend.student.add', $data);
    }

    public function store(Request $request){
        DB::transaction(function() use($request){
            $code = $this->randomString(8);
            /* User Info */
            $user = new User();
            $user->user_type_id = $request->user_type_id;
            $user->role_id = $request->role_id;
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

        return redirect()->route('admin.student');
    }

   public function view(){
        return view('backend.student.view');
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
