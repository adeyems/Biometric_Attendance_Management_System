<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Student;
use App\StudentParent;
use App\Teacher;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    public $successStatus = 200;

    public function registerFingerprint(Request $request)
    {
        $id = $request->id;
        $fingerprintData = $request->fingerprint;

        $data = Student::updateFingerprint($id, $fingerprintData);
        return $data ? response()->json(['status' => "success", 'data' => "Registered Successfully."], $this->successStatus) :
            response()->json(['status' => 'error'], 500);

    }

    public function checkPhone(Request $request) {
        $errors = [];
        if ((substr($request->mobile_no, 0, 4) != "+353") || (strlen($request->mobile_no) != 13)) {
           return  response()->json(["status" => false, "data" => "Mobile Number should start with +353 and 9 other integer characters"]);
        }
    }

    public function checkEmail(Request $request){
        $emailType = explode("@", $request->email);

        if ($emailType != "gmail.com" && $emailType != "yahoo.com" && $emailType != "outlook.com" && $emailType != "hotmail.co.uk") {
            response()->json(["data" => "Emails accepted are gmail.com, yahoo.com, outlook.com and hotmail.com"]);
        }
    }

    public function isFingerPrintMatched(Request $request)
    {

        $except = [];
        if (!Student::studentExists($request->student_no)) {
            $errors["a"] = "No student found with the student $request->student_no";
            array_push($except, 'student_no');
        }

        if (StudentParent::findByStudentNo($request->student_no)) {
            $errors["b"] = "A parent is associated with this student $request->student_no";
            array_push($except, 'student_no');
        }



        $emailType = explode("@", $request->username)[1];

        if ($emailType != "gmail.com" && $emailType != "yahoo.com" && $emailType != "outlook.com" && $emailType != "hotmail.co.uk") {
            $errors["d"] = "Emails accepted are gmail.com, yahoo.com, outlook.com and hotmail.com";
            array_push($except, 'username');
        }

        if (StudentParent::getByEmail($request->username) || Teacher::getByEmail($request->username)) {
            $errors["e"] = "An account is associated with the email address $request->username";
            array_push($except, 'username');
        }

        $uppercase = preg_match('@[A-Z]@', $request->password);
        $lowercase = preg_match('@[a-z]@', $request->password);
        $number = preg_match('@[0-9]@', $request->password);
        $specialCharacters = preg_match('@[\W]@', $request->password);

        if (!$uppercase || !$lowercase || !$number || !$specialCharacters || strlen($request->password) < 8) {
            $errors["f"] = "Password should contain at least an uppercase letter, a lower case letter, a number, a special character and a minimum length of 8";
        }

        if ($request->password != $request->password_confirmation) {
            $errors["g"] = "Password and Confirm Password do not match";
        }
    }
}
