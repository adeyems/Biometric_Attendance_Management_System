@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">{{ __('Student Daily Attendance') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('show-daily-attendance') }}">
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
                                    <label for="enddate" class="col-md-4 col-form-label text-md-right">{{ __(' Time in school entrance') }}</label>

                                    <div class="col-md-6">
                                        <input id="enddate" type="time" disabled class="form-control @error('mobile_no') is-invalid @enderror" name="" value="{{ $ISEReport->time }}" required autocomplete="mobile-no">
                                        @error('mobile_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <label for="enddate" class="col-md-4 col-form-label text-md-right">{{ __(' Time in school exit') }}</label>

                                    <div class="col-md-6">
                                        <input id="enddate" type="time" disabled class="form-control @error('mobile_no') is-invalid @enderror" name="" value="{{ $ISExitReport->time }}" required autocomplete="mobile-no">
                                        @error('mobile_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <label for="enddate" class="col-md-4 col-form-label text-md-right">{{ __(' Time on bus to school') }}</label>

                                    <div class="col-md-6">
                                        <input id="enddate" type="time" disabled class="form-control @error('mobile_no') is-invalid @enderror" name="" value="{{ $OBTSReport->time }}" required autocomplete="mobile-no">
                                        @error('mobile_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <label for="enddate" class="col-md-4 col-form-label text-md-right">{{ __(' Time off bus to school') }}</label>

                                    <div class="col-md-6">
                                        <input id="enddate" type="time" disabled class="form-control @error('mobile_no') is-invalid @enderror" name="" value="{{ $OffBTSReport->time }}" required autocomplete="mobile-no">
                                        @error('mobile_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <label for="enddate" class="col-md-4 col-form-label text-md-right">{{ __(' Time on bus to home') }}</label>

                                    <div class="col-md-6">
                                        <input id="enddate" type="time" disabled class="form-control @error('mobile_no') is-invalid @enderror" name="" value="{{ $OBTHReport->time }}" required autocomplete="mobile-no">
                                        @error('mobile_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <label for="enddate" class="col-md-4 col-form-label text-md-right">{{ __(' Time off bus to home') }}</label>

                                    <div class="col-md-6">
                                        <input id="enddate" type="time" disabled class="form-control @error('mobile_no') is-invalid @enderror" name="" value="{{ $OffBTHReport->time }}" required autocomplete="mobile-no">
                                        @error('mobile_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                @if($next)
                                <div class="form-group row mb-0">
                                    <div class="col-md-4 offset-md-2">
                                        <a href='{{ route("next-daily-attendance", ["id" => $next]) }}' class="btn btn-primary">
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
                                   {{-- <div class="col-md-4 offset-md-2">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Get Report') }}
                                        </button>
                                    </div>--}}
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
