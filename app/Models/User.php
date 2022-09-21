<?php

namespace App\Models;

use App\Models\Health\Health;
use App\Models\Role\Role;
use App\Models\School\School;
use App\Models\Student\Student;
use App\Models\User\UserType;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    	
    protected $fillable = [
        'role_id',	'user_type_id',	'name',	'first_name', 
        'last_name','date_of_birth', 'gender', 'religion', 
        'nationality',	'phone', 'address',	'email', 'image',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Relationships  
    **/

    public function role(){
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function usertype(){
        return $this->belongsTo(UserType::class, 'user_type_id', 'id');
    }

    public function school(){
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function health(){
        return $this->hasOne(Health::class, 'user_id', 'id');
    }

    public function student(){
        return $this->hasOne(Student::class, 'user_id', 'id');
    }
}
