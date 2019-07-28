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

    protected $table = 'students_parent';
    protected $primaryKey = 'parent_no';

    protected $fillable = [
        'password', 'name', 'surname', 'email', 'password', 'mobile_no', 'address', 'student_no',
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

        return Teacher::where('email', $request->get('email'))->where('password', sha1($request->get('password')))->first();

    }

    public static function create(Request $request){
        $parent = new StudentParent();

        $parent->name = $request->name;
        $parent->email = $request->email;
        $parent->surname = $request->surname;
        $parent->mobile_no = $request->mobile_no;
        $parent->address = $request->address;
        $parent->password = sha1($request->password);
        $parent->student_no =  $request->student_no;

        return $parent->save();

    }

}
