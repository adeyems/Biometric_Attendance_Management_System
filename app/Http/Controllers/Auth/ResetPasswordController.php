<?php

namespace App\Http\Controllers\Auth;

use App\Counsellor;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use App\PasswordReset;
use App\Student;
use App\StudentParent;
use App\Teacher;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('guest');
    }

    public function viewResetPassword()
    {
        return view('auth.passwords.reset');
    }

    public function viewResetEmail(){
        return view('auth.passwords.email');
    }

    public function updatePassword(Request $request){
        $uppercase = preg_match('@[A-Z]@', $request->password);
        $lowercase = preg_match('@[a-z]@', $request->password);
        $number    = preg_match('@[0-9]@', $request->password);
        $specialCharacters = preg_match('@[\W]@', $request->password);

        if(!$uppercase || !$lowercase || !$number || !$specialCharacters || strlen($request->password) < 8) {
            return back()->with('error', "Password should contain at least an uppercase letter, a lower case letter,
             a number, a special character and a minimum length of 8");
        }

        if ($request->password != $request->password_confirmation){
            return back()->with('error', "Password and Confirm Password do not match");
        }

        $user = session()->get('userObj')[0];
        if ($this->getUserType($user->userType)->updatePassword($user, $request->password)) {
            return redirect("/login/$user->userType")->with('status', "Password Changed Successfully. You can now log in to your account");
        }

        return back()->with('fail', 'Sorry, An error occurred.');
    }


    public function sendResetEmail(Request $request){
        $user = StudentParent::getByEmail($request->email) ?? Teacher::getByEmail($request->email);

        if ($user){
            $home = 'http://' . $_SERVER['HTTP_HOST'];
            $url =  $home . '/reset/' . PasswordReset::create($user);

            if (MailController::sendReset($user->username, $home, $url)){
                return back()->with('status', 'A reset link has been sent to your email address');
            }
            else{
                return back()->with('fail', 'Sorry, An error occurred.');

            }
        }
        return back()->with('fail', 'Sorry, We could not find a user with this email');

    }

    public function resetPassword(string $token)
    {
        $user = PasswordReset::findByToken($token);
        if (!$user){
            return redirect('/password/email')->with('fail', "This link has expired or is invalid.");
        }
        session()->push('userObj', $user);

        return redirect()->route('reset-password');


    }

    private function getUserType(string $userType) {
        switch ($userType) {
            case 'parent':
                return new StudentParent();
            case 'teacher':
                return new Teacher;
        }
    }
}
