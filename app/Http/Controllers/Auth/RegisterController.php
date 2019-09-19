<?php

namespace App\Http\Controllers\Auth;

use App\Counsellor;
use App\Student;
use App\StudentParent;
use App\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function student() {

        $teachersNames = Teacher::getTeachersName();

        return view('auth.register.student')->with('teachersNames', $teachersNames);
    }

    public function studentParent() {
        return view('auth.register.parent');
    }

    public function teacher() {
        return view('auth.register.teacher');
    }

    public function createStudent(Request $request) {


         if (Student::create($request)) {
             $request->session()->flash('status', 'Your account was created successfully!');
             return redirect('/login/student');
         }

         else{
             $teachersNames = Teacher::getTeachersName();

             return view('auth.register.student')->with('teachersNames', $teachersNames)->with('error',  "Sorry, An error occurred");
         }
    }

    public function createParent(Request $request) {
        $errors = [];
        $except = [];
        if (!Student::studentExists($request->student_no)){
            $errors["a"] = "No student found with the student $request->student_no";
            array_push($except, 'student_no');
        }

        if (StudentParent::findByStudentNo($request->student_no)){
            $errors["b"] = "A parent is associated with this student $request->student_no";
            array_push($except, 'student_no');
        }

        if ((substr($request->mobile_no,0,4) != "+353") || (strlen($request->mobile_no) != 13)){
            $errors["c"] = "Mobile Number should start with +353 and 9 other integer characters";
            array_push($except, 'mobile_no');
        }

        $emailType = explode("@", $request->username)[1];

        if ($emailType != "gmail.com" && $emailType != "yahoo.com" && $emailType != "outlook.com" && $emailType != "hotmail.co.uk"){
            $errors["d"] = "Emails accepted are gmail.com, yahoo.com, outlook.com and hotmail.com";
            array_push($except, 'username');
        }

        if (StudentParent::getByEmail($request->username) || Teacher::getByEmail($request->username)){
            $errors["e"] = "An account is associated with the email address $request->username";
            array_push($except, 'username');
        }

        $uppercase = preg_match('@[A-Z]@', $request->password);
        $lowercase = preg_match('@[a-z]@', $request->password);
        $number    = preg_match('@[0-9]@', $request->password);
        $specialCharacters = preg_match('@[\W]@', $request->password);

        if(!$uppercase || !$lowercase || !$number || !$specialCharacters || strlen($request->password) < 8) {
            $errors["f"] = "Password should contain at least an uppercase letter, a lower case letter, a number, a special character and a minimum length of 8";
        }

        if ($request->password != $request->password_confirmation){
            $errors["g"] = "Password and Confirm Password do not match";
        }
        if (!empty($errors)) {
            return back()->withInput(Input::except($except))->with('error', $errors);
        }else {
            if (StudentParent::create($request)) {
                $request->session()->flash('status', 'Account created successful!');
                return redirect('/login/parent');
            } else {
                return view('auth.register.parent')->with('error', "Sorry, An error occurred");
            }
        }
    }

    public function createTeacher(Request $request) {

        if ($request->password != $request->password_confirmation){
            return back()->with('error',  "Password and the Re-typed Password do no match");
        }
         if (!Teacher::getTeacherByNo($request->teacher_no)){
             return back()->with('error',  "No Teacher Number Found.");
         }

        if (Teacher::create($request)) {
            $request->session()->flash('status', 'Account created successful!');
            return redirect('/login/teacher');
        }

        else{
            return back()->with('error',  "Sorry, An error occurred");
        }
    }

}
