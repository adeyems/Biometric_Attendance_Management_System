<?php

namespace App\Http\Controllers;

use App\RequestReport;
use App\StudentParent;
use App\Teacher;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     *
     */
    public function __construct()
    {
        //$this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = session()->get('role')[0];

        if ( $role != 'Parent') {
            return redirect('/');
        }

        return view('parent-home');
    }

    public function requestReport() {
        $role = session()->get('role')[0];

        if ( $role != 'Parent') {
            return redirect('/');
        }
        $parent = StudentParent::findByEmail(session()->get('user')[0]["username"]);
        return view('request-report')->with("report_no", "RN" . time())
            ->with('parent', $parent)
            ->with('teachers', Teacher::getAllTeachers());
    }

    public function submitRequestReport(Request $request){

        if (RequestReport::create($request)) {
            $request->session()->flash('status', 'Your report was submitted successfully!');
            return redirect('/home');
        }

        else{
            return view('request-report')->with('error',  "Sorry, An error occurred");
        }
    }
}
