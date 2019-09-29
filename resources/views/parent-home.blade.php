@extends('layouts.app')

@section('title')
    <title>Dashboard</title>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">{{ session()->get('role')[0] }} Home</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible text-center" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible text-center" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session()->get('role')[0] == 'Parent')
                            <div class="col-md-12">
                                <div class="links title m-b-md text-center">
                                    @if($button)<a href="{{ route('request-report') }}" class="btn btn-primary">Request Student Report</a>@endif
                                </div>
                            </div>
                        @endif
                    </div>
                    @isset ($ISEReports)
                        <div class="alert text-center" role="alert">
                            <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Time</th>
                                    @foreach($ISEReports as $report)
                                        @if ($loop->first)
                                            <th scope="col">Start Date</th>
                                        @elseif ($loop->last)
                                            <th scope="col">End Date</th>
                                        @else
                                            <th scope="col">Next Date</th>
                                        @endif
                                    @endforeach
                                </tr>
                                </thead>
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col"></th>
                                    @foreach($ISEReports as $report)
                                        <th scope="col">{{ $report->date }}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">{{ __(' Time on bus to school') }}</th>
                                    @foreach($OBTSReports as $report)
                                        <td>{{ $report->time ?? 'Absent' }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th scope="row">{{ __(' Time off bus to school') }}</th>
                                    @foreach($OffBTSReports as $report)
                                        <td>{{ $report->time ?? 'Absent' }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th scope="row">{{ __(' Time in school Entrance') }}</th>
                                    @foreach($ISEReports as $report)
                                        <td>{{ $report->time ?? 'Absent' }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th scope="row">{{ __(' Time in school Exit') }}</th>
                                    @foreach($ISExitReports as $report)
                                        <td>{{ $report->time ?? 'Absent' }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th scope="row">{{ __(' Time on bus to home') }}</th>
                                    @foreach($OBTHReports as $report)
                                        <td>{{ $report->time ?? 'Absent' }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th scope="row">{{ __(' Time off bus to home') }}</th>
                                    @foreach($OffBTHReports as $report)
                                        <td>{{ $report->time ?? 'Absent' }}</td>
                                    @endforeach
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4 offset-md-2">
                                <a href="{{ route('parent-home') }}" class="btn btn-primary">
                                    {{ __('Back') }}
                                </a>
                            </div>
                            <div class="col-md-4 offset-md-2">
                                <a href="#" class="btn btn-primary" onclick="window.print()">
                                    {{ __('Print') }}
                                </a>
                            </div>
                        </div>
                </div>
                @endisset
            </div>
        </div>
    </div>
@endsection
