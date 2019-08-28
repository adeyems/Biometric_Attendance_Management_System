@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">{{ __('Student Attendance Report') }}</div>

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
                        <form method="POST" action="{{ route('create-attendance-report') }}"  id="form">
                            @csrf

                            <div class="form-group row" id="signup-form">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Choose Student Name and Surname') }}</label>

                                <div class="col-md-6">
                                    <select class="form-group form-control" required name="student_no" onchange="submitForm()" id="select">
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
                                    <input id="start-date" type="date" max="{{ date('Y-m-d', strtotime('-1 day')) }}" class="form-control @error('mobile_no') is-invalid @enderror" value="{{$start_date ?? ''}}" name="start_date" required>
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
                                    <input id="end-date" type="date" max="{{ date('Y-m-d', strtotime('-1 day')) }}" class="form-control @error('mobile_no') is-invalid @enderror" value="{{$end_date ?? ''}}" name="end_date" required>
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
                                    @if($previous)
                                        <div class="col-md-4 offset-md-2">
                                            <a href='{{ route("next-attendance-report", ["id" => $previous]) }}' class="btn btn-primary">
                                                {{ __('Previous Student') }}
                                            </a>
                                        </div>
                                    @endif
                                    @if($next)
                                        <div class="col-md-4 offset-md-2">
                                            <a href='{{ route("next-attendance-report", ["id" => $next]) }}' class="btn btn-primary">
                                                {{ __('Next Student') }}
                                            </a>
                                        </div>
                                    @endif
                                </div><br>
                                <div class="form-group row">

                                    <div class="col-md-4 offset-md-2">
                                        <a href="{{ route('teacher-home') }}" class="btn btn-primary">
                                            {{ __('Back') }}
                                        </a>
                                    </div>
                                    <div class="col-md-4 offset-md-2">
                                        <a href="#" class="btn btn-primary" onclick="window.print()">
                                            {{ __('Print') }}
                                        </a>
                                    </div>
                                </div>
                                @endisset
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        function submitForm() {
            const startDate =  document.getElementById('start-date').value;
            const endDate = document.getElementById('end-date').value;
            const select = document.getElementById('select').value;
            console.log('selected');
            const form =  document.getElementById('form');
            console.log(startDate, endDate, select);
            if (startDate != '' && endDate != '' && select != '') {
                if (Date.parse(startDate) >= Date.parse(endDate)){
                    alert('Start date must be less than end date.');
                    return false;
                }
                form.submit();
            }
        }
    </script>

@endsection
