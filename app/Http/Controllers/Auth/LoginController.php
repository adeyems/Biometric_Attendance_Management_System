<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\StudentParent;
use App\Teacher;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    }

    public function parent()
    {
        if (session()->has('user')){
            $user = session()->get('role');
            if ($user[0] == 'Parent')
                return redirect('/parent/home');

            return redirect('/teacher/home');
        }
        return view('auth.login')->with('user', 'Parent')->with('login', 'parentLogin')->with('register', 'parentRegister');
    }

    public function teacher()
    {

        if (session()->has('user')){
            $user = session()->get('role');
            if ($user[0] == 'Parent')
                return redirect('/parent/home');

            return redirect('/teacher/home');
        }

        return view('auth.login')->with('user', 'Teacher')->with('login', 'teacherLogin');
    }

    public function teacherLogin(Request $request)
    {
        //dd($request->username, sha1($request->password));
        $teacher = Teacher::login($request);

        if ($teacher){
            session()->push('user', $teacher);
            session()->push('role', 'Teacher');
            $request->session()->flash('status', 'Login successful!');
            return redirect('/teacher/home');
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
            return redirect('/parent/home');
        }

        return view('auth.login', ['error' => 'Login unsuccessful. Check your login credential', 'user' => 'Parent', 'login' => 'parentLogin', 'register' => 'parentRegister']);

    }

    protected function logOut()
    {
        Auth::logout();
        redirect('/');
    }
}
