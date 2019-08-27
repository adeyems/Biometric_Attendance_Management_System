<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class StudentBiometricInSchoolExit extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'students_biometric_in_school_exit';
    protected $primaryKey = 'exit_biometric_number';

    protected $fillable = ['exit_biometric_number', 'student_no', 'date', 'time'];


    public static function getReport($from, $to, $studentNo)
    {
        $from = date($from);
        $to = date($to);

        return self::where('student_no', $studentNo)->whereBetween('date', [$from, $to])->get();
    }

    public static function getDailyReport($date, $studentNo)
    {
        return self::where('student_no', $studentNo)->where('date', $date)->first();
    }

    public static function markAttendance($id) {
        $student_no = Student::getById($id)->student_no;
        $attendance = new self();
        $attendance->student_no = $student_no;
        $attendance->date = date('Y-m-d');
        $attendance->time = date('h:i A');

        return $attendance->save();
    }

}
