<?php
/**
 * Created by PhpStorm.
 * User: abdulqudus
 * Date: 8/5/19
 * Time: 6:41 PM
 */

namespace App\Http\Controllers;


class HomeController
{

    public function index()
    {
        if (session()->has('user')){
            $user = session()->get('role');
            if ($user[0] == 'Parent')
                return redirect('/parent/home');

            return redirect('/teacher/home');
        }

        return view('welcome');
    }
}
