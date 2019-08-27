<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;


class FingerprintController extends Controller
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

    public function isFingerPrintMatched(Request $request)
    {
        $id = $request->id;
        $fingerprintData = $request->fingerprint;

        if (!$id || !$fingerprintData)
            response()->json(['status' => 'error', 'message' => "Id and Fingerprint are required."], 500);

        $data = Student::getByFingerprint($id, $fingerprintData);
        return $data ? response()->json(['status' => "success", 'matched' => true], $this->successStatus) :
            response()->json(['status' => 'success', 'matched' => false], 200);

    }

    public function getAllStudents() {
        $data = Student::getAll();
        return $data ? response()->json(['status' => "success", 'data' => $data], $this->successStatus) :
            response()->json(['status' => 'error'], 500);
    }

    public function markAttendance($id) {
        Student::markAttendance($id);
    }


}
