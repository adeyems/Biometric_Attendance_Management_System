<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Symfony\Component\HttpFoundation\Request;

class StudentAttendanceCount extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'student_attendance_counts';


    protected $fillable = ['student_no', 'counts'];


    public static function register(string $student_no) {
        $student = new self();

        $student->student_no = $student_no;

        $student->save();
    }

    public static function studentExists($student_no){
        return self::where('student_no', $student_no)->first();
    }

    public static function markAttendance($student_no) {
        $student = self::where('student_no', $student_no)->first();
        $student->count += 1;

        $student->save();

        return $student->count;
    }
}
