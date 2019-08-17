<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Symfony\Component\HttpFoundation\Request;

class Teacher extends Model {
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'teachers';
    protected $primaryKey = 'teacher_no';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'teacher_no', 'password', 'teacher_name', 'teacher_surname', 'class', 'subject', 'username', 'mobile_no',
    ];

    public static function login(Request $request) {

        return self::where('username', $request->get('username'))->where('password', sha1($request->get('password')))->first();

    }

    public static function getNo($username) {

        return Teacher::select('teacher_no')->where('username', $username)->first();

    }

    public static final function getAllTeachers() {
        return Teacher::all();
    }

    public static function getTeacherByNo(string $no) {
        return self::where('teacher_no', $no)->first();
    }

    public static function getNameById(string $teacher_no) {
        return self::select('teacher_name', 'teacher_surname')->where('teacher_no', $teacher_no)->first();
    }

    public static function create(Request $request){
        $teacher = self::find($request->teacher_no);

        $teacher->teacher_name = $request->name;
        $teacher->username = $request->username;
        $teacher->teacher_surname = $request->surname;
        $teacher->mobile_no = $request->mobile_no;
        $teacher->class = $request->class;
        $teacher->subject = $request->subject;
        $teacher->password = sha1($request->password);
        $teacher->username = ($request->username);

        return $teacher->save();

    }
}
