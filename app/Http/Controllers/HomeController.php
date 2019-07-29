<?php

namespace App\Http\Controllers;

use App\RequestReport;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        if (!session()->has('user')) {
            return redirect('/');
        }

        return view('parent-home');
    }

    public function requestReport(){

        return view('request-report');
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
