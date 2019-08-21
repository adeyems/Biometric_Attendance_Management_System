<?php

namespace App\Http\Controllers;

use App\RequestReport;
use App\Student;
use App\StudentBiometricInSchoolEntrance;
use App\StudentBiometricInSchoolExit;
use App\StudentBiometricOffBusToHome;
use App\StudentBiometricOffBusToSchool;
use App\StudentBiometricOnBusToHome;
use App\StudentBiometricOnBusToSchool;
use App\StudentParent;
use App\Teacher;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     *
     */
    public function __construct()
    {
        //$this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = session()->get('role')[0];

        if ( $role != 'Parent') {
            return redirect('/');
        }

        return view('parent-home');
    }

    public function requestReport() {
        $role = session()->get('role')[0];

        if ( $role != 'Parent') {
            return redirect('/');
        }
        $parent = StudentParent::findByEmail(session()->get('user')[0]["username"]);
        $student = Student::studentExists($parent["student_no"]);
        return view('request-report')->with("report_no", "RN" . time())
            ->with('parent', $parent)
            ->with('teacher', Teacher::getNameById($student->student_class_teacher_number));
    }

    public function submitRequestReport(Request $request){

        $ISEReports = StudentBiometricInSchoolEntrance::getReport($request->start_date,
            $request->end_date, $request->student_no);

        $ISExitReports = StudentBiometricInSchoolExit::getReport($request->start_date,
            $request->end_date, $request->student_no);

        $OBTHReports = StudentBiometricOnBusToHome::getReport($request->start_date,
            $request->end_date, $request->student_no);

        $OBTSReports = StudentBiometricOnBusToSchool::getReport($request->start_date,
            $request->end_date, $request->student_no);

        $OffBTHReports = StudentBiometricOffBusToHome::getReport($request->start_date,
            $request->end_date, $request->student_no);

        $OffBTSReports = StudentBiometricOffBusToSchool::getReport($request->start_date,
            $request->end_date, $request->student_no);

        if (RequestReport::create($request)) {
            if (!!count($ISEReports) > 0) {
                $request->session()->flash('status', 'Your report was submitted successfully!');

                return view('parent-home', [
                    'ISEReports' => $ISEReports,
                    'ISExitReports' => $ISExitReports,
                    'OBTHReports' => $OBTHReports,
                    'OBTSReports' => $OBTSReports,
                    'OffBTHReports' => $OffBTHReports,
                    'OffBTSReports' => $OffBTSReports,
                ]);
            } else {
                $request->session()->flash('error', "No report for the selected dates $request->start_date to $request->end_date");

                return view('parent-home');
            }
        }

            return back()->with('error',  "Sorry, An error occurred");
    }
}
