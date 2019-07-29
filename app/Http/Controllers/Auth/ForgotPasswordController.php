<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\PasswordReset;
use App\StudentParent;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
 /*   public function __construct()
    {
        $this->middleware('guest');
    }*/

    public function resetEmail(){
        return view('auth.password.reset');
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function sendResetLinkEmail(Request $request)
    {
        if (StudentParent::emailExists($request->email)){
           $token = PasswordReset::generateAndSaveToken($request->email);
            $url = 'https://' . $_SERVER['HTTP_HOST'] . '/password/reset/' . $token;

            \App\Mail::send(  $request->email, 'Password Reset Link', "Click or copy this link to reset your password: $token",

            "Click or copy this link to reset your password <a href=$token>$token<a/>"             );

            $request->session()->flash('status', 'An link has be sent your email to reset your password .');
        }
        $request->session()->flash('status', 'An password reset link has been sent to the email address if you have an existing account.');
        return redirect('/password/reset');

    }
}
