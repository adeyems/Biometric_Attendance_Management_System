@extends('layouts.app')

@section('title')
    <title>Dashboard</title>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ session()->get('role')[0] }} Home</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success text-center" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ( session()->get('role')[0] == 'Parent')
                        <div class="col-md-12">
                            <div class="links title m-b-md text-center" style="padding-bottom: 50px">
                                <a href="{{ route('request-report') }}" class="btn btn-primary">Request Student Report</a>
                            </div>
                            <div class="links title m-b-md text-center">
                                <a href="#" class="btn btn-primary">View Notification</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
