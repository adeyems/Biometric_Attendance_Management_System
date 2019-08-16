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
    protected $primaryKey = 'employment_no';

    protected $fillable = [
        'password', 'username',
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

}
