@extends('layouts.app')

@section('title')
    <title>Dashboard</title>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center"
                style="
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;">
            <div class="col-md-12">
                <div class="title text-center m-b-md" style="padding-bottom: 80px"><h5>Login Screen</h5></div>
                <div class="links title m-b-md offset-2 align-content-center">
                    <a href="{{ route('login.student') }}" style="margin-right: 30px;" class="btn btn-primary">Student</a>
                    <a href="{{ route('login.parent') }}" class="btn btn-primary" style="margin-right: 30px;">Parent</a>
                    <a href="{{ url('/login/teacher') }}" class="btn btn-primary" style="margin-right: 30px;">Teacher</a>
                    <a href="{{ url('/login/counsellor') }}" class="btn btn-primary">Guidance and Counsellor</a>
                </div>
            </div>
        </div>
    </div>
@endsection
