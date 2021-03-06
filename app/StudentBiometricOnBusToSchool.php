<?php

namespace App;

use App\Http\Controllers\SMSController;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class StudentBiometricOnBusToSchool extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'students_biometric_on_bus_to_school';
    protected $primaryKey = 'on_bus_to_school_number';

    protected $fillable = ['on_bus_to_school_number', 'student_no', 'date', 'time'];


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

    public function markAttendance($id) {
        $student_no = Student::getById($id)->student_no;
        $attendance = new self();
        $attendance->student_no = $student_no;
        $attendance->date = date('Y-m-d');
        $attendance->time = date('h:i A');

        $parent = StudentParent::findByStudentNo($student_no);
        SMSController::sendSMS($parent->mobile_no, 'Notification from Christ_light international school. Your child is on the bus to school.');

       return $attendance->save();
    }
}
