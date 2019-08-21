<?php
/**
 * Created by PhpStorm.
 * User: abdulqudus
 * Date: 8/5/19
 * Time: 11:36 PM
 */

namespace App\Http\Controllers;

use App\RequestReport;
use App\Student;
use App\StudentBiometricInSchoolEntrance;
use App\StudentBiometricInSchoolExit;
use App\StudentBiometricOffBusToHome;
use App\StudentBiometricOffBusToSchool;
use App\StudentBiometricOnBusToHome;
use App\StudentBiometricOnBusToSchool;
use Symfony\Component\HttpFoundation\Request;

class StudentController
{
    public function attendance() {
        $role = session()->get('role')[0];

        if ( $role != 'Teacher') {
            return redirect('/');
        }

        $students =  Student::getNameAndNumber();

        return view('attendance')->with('students', $students)->with('go', true);
    }

    public function attendanceNext() {
        $role = session()->get('role')[0];

        if ( $role != 'Teacher') {
            return redirect('/');
        }

        $students =  Student::getNameAndNumber();
        dd(session()->get('studentIndex'));
        session()->get('studentIndex')[0] += 1;
        dd(session()->get('studentIndex')[0]);
        dd($students[session()->get('studentIndex')[0] += 1]);
        return view('attendance-list')
            ->with('students', $students)->with('i', 0)
            ->with('active', $students[session()->get('studentIndex')[0] += 1]);
    }

    public function attendanceReport() {

        $role = session()->get('role')[0];

        if ( $role != 'Teacher') {
            return redirect('/');
        }

        $students =  Student::getNameAndNumber();
        return view('attendance-report')->with('students', $students);
    }

    public function attendanceDailyReport(Request $request) {

        $role = session()->get('role')[0];

        if ( $role != 'Teacher') {
            return redirect('/');
        }

        $request->date = (date('Y-m-d', strtotime('-20 days')));

        $students =  Student::getNameAndNumber();

        $id = Student::studentExists($request->student_no)->id;

        $next = Student::where('id', '>', $id)->min('id');

        $ISEReport = StudentBiometricInSchoolEntrance::getDailyReport($request->date,$request->student_no);

        $ISExitReport = StudentBiometricInSchoolExit::getDailyReport($request->date,$request->student_no);

        $OBTHReport = StudentBiometricOnBusToHome::getDailyReport($request->date, $request->student_no);

        $OBTSReport = StudentBiometricOnBusToSchool::getDailyReport($request->date,$request->student_no);

        $OffBTHReport = StudentBiometricOffBusToHome::getDailyReport($request->date,$request->student_no);

        $OffBTSReport = StudentBiometricOffBusToSchool::getDailyReport($request->date,$request->student_no);

        if (!!count($ISEReport) > 0) {
            $request->session()->flash('status', 'Your report was submitted successfully!');

            return view('attendance', [
                'ISEReport' => $ISEReport,
                'ISExitReport' => $ISExitReport,
                'OBTHReport' => $OBTHReport,
                'OBTSReport' => $OBTSReport,
                'OffBTHReport' => $OffBTHReport,
                'OffBTSReport' => $OffBTSReport,
                'students' => $students,
                'currentStudentNo' => $request->student_no,
                'next' => $next
            ]);
        }
        else {
            $request->session()->flash('error', "No report for the selected date $request->date");

            return view('attendance')->with('students', $students);
        }
    }

    public function nextDailyReport(Request $request, int $id) {


        $role = session()->get('role')[0];

        if ( $role != 'Teacher') {
            return redirect('/');
        }

        $request->date = (date('Y-m-d', strtotime('-20 days')));

        $students =  Student::getNameAndNumber();

        $student = Student::getById($id);

        $request->student_no = $student->student_no;

        $next = Student::where('id', '>', $id)->min('id');

        $ISEReport = StudentBiometricInSchoolEntrance::getDailyReport($request->date,$request->student_no);

        $ISExitReport = StudentBiometricInSchoolExit::getDailyReport($request->date,$request->student_no);

        $OBTHReport = StudentBiometricOnBusToHome::getDailyReport($request->date, $request->student_no);

        $OBTSReport = StudentBiometricOnBusToSchool::getDailyReport($request->date,$request->student_no);

        $OffBTHReport = StudentBiometricOffBusToHome::getDailyReport($request->date,$request->student_no);

        $OffBTSReport = StudentBiometricOffBusToSchool::getDailyReport($request->date,$request->student_no);

        if (!!count($ISEReport) > 0) {
            $request->session()->flash('status', 'Your report was submitted successfully!');

            return view('attendance', [
                'ISEReport' => $ISEReport,
                'ISExitReport' => $ISExitReport,
                'OBTHReport' => $OBTHReport,
                'OBTSReport' => $OBTSReport,
                'OffBTHReport' => $OffBTHReport,
                'OffBTSReport' => $OffBTSReport,
                'students' => $students,
                'currentStudentNo' => $request->student_no,
                'next' => $next
            ]);
        }
        else {
            $request->session()->flash('error', "No report for the selected date $request->date");

            return view('attendance')->with('students', $students);
        }
    }


    public function createAttendanceReport(Request $request){

        $role = session()->get('role')[0];

        if ( $role != 'Teacher') {
            return redirect('/');
        }

        $students =  Student::getNameAndNumber();

        $id = Student::studentExists($request->student_no)->id;

        $next = Student::where('id', '>', $id)->min('id');

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


        if (!!count($ISEReports) > 0) {
            $request->session()->flash('status', 'Your report was submitted successfully!');

            return view('attendance-report', [
                'ISEReports' => $ISEReports,
                'ISExitReports' => $ISExitReports,
                'OBTHReports' => $OBTHReports,
                'OBTSReports' => $OBTSReports,
                'OffBTHReports' => $OffBTHReports,
                'OffBTSReports' => $OffBTSReports,
                'students' => $students,
                'currentStudentNo' => $request->student_no,
                'next' => $next
            ]);

        } else {
            $request->session()->flash('error', "No report for the selected dates $request->start_date to $request->end_date");

            return view('attendance-report')->with('students', $students);
        }
    }

    public function nextAttendanceReport(Request $request, int $id){

        $role = session()->get('role')[0];

        if ( $role != 'Teacher') {
            return redirect('/');
        }

        $students =  Student::getNameAndNumber();

        $student = Student::getById($id);

        $request->student_no = $student->student_no;

        $next = Student::where('id', '>', $id)->min('id');

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

        if (!!count($ISEReports) > 0) {
                $request->session()->flash('status', 'Your report was submitted successfully!');

                return view('attendance-report', [
                    'ISEReports' => $ISEReports,
                    'ISExitReports' => $ISExitReports,
                    'OBTHReports' => $OBTHReports,
                    'OBTSReports' => $OBTSReports,
                    'OffBTHReports' => $OffBTHReports,
                    'OffBTSReports' => $OffBTSReports,
                    'students' => $students,
                    'currentStudentNo' => $request->student_no,
                    'next' => $next
                ]);

            } else {
                $request->session()->flash('error', "No report for the selected dates $request->start_date to $request->end_date");

                return view('attendance-report')->with('students', $students);
        }
    }
}