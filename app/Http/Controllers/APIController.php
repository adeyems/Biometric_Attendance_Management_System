<?php

namespace App\Http\Controllers;

use App\StudentParent;
use App\Student;

class APIController extends Controller
{
    public function validateUserParent()
    {
        $is_valid = ! StudentParent::usernameExists($_GET['username']);

        header('Content-Type: application/json');

        echo json_encode($is_valid);
    }

    /**
     *
     */
    public function validateExistingStudent()
    {
        $is_valid =  Student::studentExists($_GET['student-no']) && StudentParent::studentExists($_GET['student-no']);

        header('Content-Type: application/json');

        echo json_encode($is_valid);
    }



}
