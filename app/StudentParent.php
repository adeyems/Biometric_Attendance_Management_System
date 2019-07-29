<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Symfony\Component\HttpFoundation\Request;

class StudentParent extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'students_parents';
    protected $primaryKey = 'parent_no';

    protected $fillable = [
        'password', 'parent_name', 'parent_surname', 'username', 'password', 'mobile_no', 'home_address', 'student_no',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function login(Request $request) {

        return StudentParent::where('username', $request->get('username'))->where('password', sha1($request->get('password')))->first();

    }

    public static function create(Request $request){
        $parent = new StudentParent();

        $parent->parent_name = $request->name;
        $parent->username = $request->username;
        $parent->parent_surname = $request->surname;
        $parent->mobile_no = $request->mobile_no;
        $parent->home_address = $request->address;
        $parent->password = sha1($request->password);
        $parent->username = ($request->username);
        $parent->student_no =  $request->student_no;

        return $parent->save();

    }

    public static function usernameExists(string $username) {
        return StudentParent::where('username', $username)->first();
    }

    public static function studentExists(string $studentNo) {
        return !StudentParent::where('student_no', $studentNo)->first();
    }

    public static function emailExists(string $email) {
        return StudentParent::where('username', $email)->first();
    }


}
