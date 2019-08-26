@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">{{ __('Student Attendance Report') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('create-attendance-report') }}">
                            @csrf

                            <div class="form-group row" id="signup-form">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Choose Student Name and Surname') }}</label>

                                <div class="col-md-6">
                                    <select class="form-group form-control" required name="student_no">
                                        <option value="">Select student name</option>
                                        @foreach($students as $student)
                                            <option value="{{ $student->student_no }}"
                                                    @isset($currentStudentNo)
                                                            @if($currentStudentNo == $student->student_no)
                                                            selected
                                                            @endif
                                                    @endisset> {{ $student->student_name }} {{ $student->student_surname }}</option>
                                        @endforeach
                                    </select>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="startdate" class="col-md-4 col-form-label text-md-right">{{ __("Report Start Date") }}</label>

                                <div class="col-md-6">
                                    <input id="startdate" type="date" max="{{ date('Y-m-d', strtotime('-1 day')) }}" class="form-control @error('mobile_no') is-invalid @enderror" value="{{$start_date ?? ''}}" name="start_date" required>
                                    @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="startdate" class="col-md-4 col-form-label text-md-right">{{ __("Report End Date") }}</label>

                                <div class="col-md-6">
                                    <input id="startdate" type="date" max="{{ date('Y-m-d', strtotime('-1 day')) }}" class="form-control @error('mobile_no') is-invalid @enderror" value="{{$end_date ?? ''}}" name="end_date" required>
                                    @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
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
                                            <th scope="row">{{ __(' Time on bus to school') }}</th>
                                            @foreach($OffBTSReports as $report)
                                                <td>{{ $report->time ?? 'Absent' }}</td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ __(' Time on bus to home') }}</th>
                                            @foreach($OffBTHReports as $report)
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
                                            <th scope="row">{{ __(' Time off bus to home') }}</th>
                                            @foreach($OffBTHReports as $report)
                                                <td>{{ $report->time ?? 'Absent' }}</td>
                                            @endforeach
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @if($next)
                            <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-2">
                                <a href='{{ route("next-attendance-report", ["id" => $next]) }}' class="btn btn-primary">
                                    {{ __('Next Student') }}
                                </a>
                            </div>
                        </div><br>
                        <div class="form-group row mb-0">
                            @endif
                            <div class="col-md-4 offset-md-2">
                                <a href="#" class="btn btn-primary">
                                    {{ __('Print') }}
                                </a>
                            </div><br><br>
                            <div class="col-md-4 offset-md-2">
                                <a href="{{ route('teacher-home') }}" class="btn btn-primary">
                                    {{ __('Back') }}
                                </a>
                            </div><br>
                                @endisset
                                <div class="col-md-4 offset-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create Report') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/Easyhttp.js') }}"></script>
    <script src="{{ asset('js/check-email.js') }}"></script>
@endsection
