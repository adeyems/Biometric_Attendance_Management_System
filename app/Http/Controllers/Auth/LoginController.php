<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\StudentParent;
use App\Teacher;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');

        if (session()->has('user')){
            redirect('/home');
        }
    }


    public function parent()
    {
        return view('auth.login')->with('user', 'Parent')->with('login', 'parentLogin')->with('register', 'parentRegister');
    }

    public function teacher()
    {
        return view('auth.login')->with('user', 'Teacher')->with('login', 'teacherLogin');
    }

    public function teacherLogin(Request $request)
    {
        $teacher = Teacher::login($request);

        if ($teacher){
            session()->push('user', $teacher);
            session()->push('role', 'Teacher');
            $request->session()->flash('status', 'Login successful!');
            return redirect('/home');
        }

        return view('auth.login', ['error' => 'Login unsuccessful. Check your login credential', 'user' => 'Teacher', 'login' => 'teacherLogin', 'register' => 'teacherRegister']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function parentLogin(Request $request)
    {
        $parent = StudentParent::login($request);

        if ($parent){
            session()->push('user', $parent);
            session()->push('role', 'Parent');
            $request->session()->flash('status', 'Login successful!');
            return redirect('/home');
        }

        return view('auth.login', ['error' => 'Login unsuccessful. Check your login credential', 'user' => 'Parent', 'login' => 'parentLogin', 'register' => 'parentRegister']);

    }

    protected function logOut()
    {
        Auth::logout();
        redirect('/');
    }
}
