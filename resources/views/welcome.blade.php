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
                <div class="links title m-b-md text-center" style="padding-bottom: 50px">
                    <a href="{{ route('login.parent') }}" class="btn btn-primary">Parent</a>
                </div>
                <div class="links title m-b-md text-center">
                 <a href="{{ url('/login/teacher') }}" class="btn btn-primary">Teacher</a>
                </div>
            </div>
        </div>
    </div>
@endsection
