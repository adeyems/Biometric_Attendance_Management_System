<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Student;
use App\StudentAttendanceCount;
use App\StudentBiometricInSchoolEntrance;
use App\StudentBiometricInSchoolExit;
use App\StudentBiometricOffBusToHome;
use App\StudentBiometricOffBusToSchool;
use App\StudentBiometricOnBusToHome;
use App\StudentBiometricOnBusToSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class FingerprintController extends Controller
{
    public $successStatus = 200;

    public function registerFingerprint(Request $request)
    {
        $id = $request->id;
        $fingerprintData = $request->fingerPrint;

        $data = Student::updateFingerprint($id, $fingerprintData);
        return $data ? response()->json(['status' => "success", 'data' => "Registered Successfully."], $this->successStatus) :
            response()->json(['status' => 'error'], 500);

    }

    public function isFingerPrintMatched($id)
    {
        if (!$id)
            response()->json(['status' => 'error', 'message' => "Id is required."], 500);
            $this->markAttendance($id);
        return  response()->json(['status' => 'success'], 200);
        /* return $data ? response()->json(['status' => "success", 'matched' => true], $this->successStatus) :
             response()->json(['status' => 'success', 'matched' => false], 200);*/
    }

    public function getAllStudents() {
        $data = Student::getAll();
        return $data ? response()->json($data, $this->successStatus) :
            response()->json(['status' => 'error'], 500);
    }

    private function markAttendance($id) {
        $student_no = Student::getById($id)->student_no;

        if (!StudentAttendanceCount::studentExists($student_no)) {
            StudentAttendanceCount::register($student_no);
            $this->getStudentCurrentAttendance(0)->markAttendance($id);
        }
        else {
            $count = StudentAttendanceCount::markAttendance($student_no);
            $this->getStudentCurrentAttendance($count)->markAttendance($id);
        }
    }

    private function getStudentCurrentAttendance(int $count): Model {
        switch ($count % 6){
            CASE 0 :
                return new StudentBiometricOnBusToSchool();
            CASE 1 :
                return new StudentBiometricOffBusToSchool();
            CASE 2 :
                return new StudentBiometricInSchoolEntrance();
            CASE 3 :
                return new StudentBiometricInSchoolExit();
            CASE 4 :
                return new StudentBiometricOnBusToHome();
            CASE 5 :
                return new StudentBiometricOffBusToHome();
        }
    }
}
