<?php
/**
 * Created by PhpStorm.
 * User: abdulqudus
 * Date: 8/5/19
 * Time: 11:36 PM
 */

namespace App\Http\Controllers;


use App\Student;

class StudentController
{
    public function attendance() {
        $students =  Student::getNameAndNumber();
        return view('attendance')->with('students', $students);
    }

    public function attendanceReport() {
        $students =  Student::getNameAndNumber();
        return view('attendance-report')->with('students', $students);
    }
}

