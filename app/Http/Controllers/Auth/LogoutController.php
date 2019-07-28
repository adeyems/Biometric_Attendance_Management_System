<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;


class LogoutController extends Controller
{
    public function index() {

        if (!session('user')){
            return redirect('/');
        }
        session()->remove('user');
        session()->remove('role');
        session()->flash('Logout Successfully');

        return redirect('/');
    }
}
