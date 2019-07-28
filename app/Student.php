<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Symfony\Component\HttpFoundation\Request;

class Student extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'students';
    protected $primaryKey = 'student_no';

    protected $fillable = [
        'name', 'surname', 'mobile_no', 'address', 'date_of_birth', 'class', 'password', 'class_teacher_name', 'class_teacher_surname',
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

        return Student::where('email', $request->get('email'))->where('password', sha1($request->get('password')))->first();

    }

    public static function create(Request $request) {
        $student = new Student();

        $student->name = $request->name;
        $student->email = $request->email ."ddeas";
        $student->surname = $request->surname;
        $student->mobile_no = $request->mobile_no;
        $student->address = $request->address;
        $student->date_of_birth = $request->date_of_birth;
        $student->class = $request->class;
        $student->password = sha1($request->password);
        $student->class_teacher_name = explode(" ", $request->class_teacher_name)[0];
        $student->class_teacher_surname = explode(" ",  $request->class_teacher_name)[1];

       return $student->save();

    }
}
