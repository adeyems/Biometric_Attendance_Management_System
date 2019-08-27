@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">{{ __('Student Daily Attendance') }}</div>

                    <div class="card-body">
                        @if ($message = Session::get('error'))

                            <div class="alert alert-danger alert-block text-center">

                                <button type="button" class="close" data-dismiss="alert">×</button>

                                <strong class="text-center">{{ $message }}</strong>

                            </div>
                        @endif
                        <form method="POST" action="{{ route('show-daily-attendance') }}" id="form">
                            @csrf

                            <div class="form-group row" id="signup-form">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Choose Student Name and Surname') }}</label>

                                <div class="col-md-6">
                                    <select class="form-group form-control" required name="student_no" onchange="submit()">
                                        <option value="">Select student name</option>
                                        @foreach($students as $student)
                                            <option value="{{ $student->student_no }}"
                                                    @isset($currentStudentNo)
                                                    @if($currentStudentNo == $student->student_no)
                                                    selected
                                                    @endif
                                                    @endisset> {{ $student->student_name }} {{ $student->student_surname }}
                                            </option>
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
                                <label for="startdate" class="col-md-4 col-form-label text-md-right">{{ __("Today's Date") }}</label>

                                <div class="col-md-6">
                                    <input id="startdate" type="date" value="{{ date('Y-m-d') }}" class="form-control @error('mobile_no') is-invalid @enderror" name="date" readonly >

                                    @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            @isset ($ISEReport)
                                <div class="form-group row">
                                    <label for="enddate" class="col-md-4 col-form-label text-md-right">{{ __(' Time on bus to school') }}</label>

                                    <div class="col-md-6">
                                        <input id="enddate"  disabled class="form-control @error('mobile_no') is-invalid @enderror" name="" value="{{ $OBTSReport->time }}" required autocomplete="mobile-no">
                                        @error('mobile_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <label for="enddate" class="col-md-4 col-form-label text-md-right">{{ __(' Time off bus to school') }}</label>

                                    <div class="col-md-6">
                                        <input id="enddate"  disabled class="form-control @error('mobile_no') is-invalid @enderror" name="" value="{{ $OffBTSReport->time }}" required autocomplete="mobile-no">
                                        @error('mobile_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <label for="enddate" class="col-md-4 col-form-label text-md-right">{{ __(' Time in school entrance') }}</label>

                                    <div class="col-md-6">
                                        <input id="enddate"  disabled class="form-control @error('mobile_no') is-invalid @enderror" name="" value="{{ $ISEReport->time }}" required autocomplete="mobile-no">
                                        @error('mobile_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <label for="enddate" class="col-md-4 col-form-label text-md-right">{{ __(' Time in school exit') }}</label>

                                    <div class="col-md-6">
                                        <input id="enddate"  disabled class="form-control @error('mobile_no') is-invalid @enderror" name="" value="{{ $ISExitReport->time }}" required autocomplete="mobile-no">
                                        @error('mobile_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <label for="enddate" class="col-md-4 col-form-label text-md-right">{{ __(' Time on bus to home') }}</label>

                                    <div class="col-md-6">
                                        <input id="enddate"  disabled class="form-control @error('mobile_no') is-invalid @enderror" name="" value="{{ $OBTHReport->time }}" required autocomplete="mobile-no">
                                        @error('mobile_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <label for="enddate" class="col-md-4 col-form-label text-md-right">{{ __(' Time off bus to home') }}</label>

                                    <div class="col-md-6">
                                        <input id="enddate" type="" disabled class="form-control @error('mobile_no') is-invalid @enderror" name="" value="{{ $OffBTHReport->time }}" required autocomplete="mobile-no">
                                        @error('mobile_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    @if($previous)
                                        <div class="col-md-4 offset-md-2">
                                            <a href='{{ route("next-daily-attendance", ["id" => $previous]) }}' class="btn btn-primary">
                                                {{ __('Previous Student') }}
                                            </a>
                                        </div>
                                    @endif
                                    @if($next)
                                        <div class="col-md-4 offset-md-2">
                                            <a href='{{ route("next-daily-attendance", ["id" => $next]) }}' class="btn btn-primary">
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function submit() {
            console.log('selected');
            const form =  document.getElementById('form');
            form.submit();
        }
    </script>
@endsection
