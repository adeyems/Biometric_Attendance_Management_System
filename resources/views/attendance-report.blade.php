@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">{{ __('Student Attendance Report') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('create-request-report') }}">
                            @csrf

                            <div class="form-group row" id="signup-form">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Choose Student Name and Surname') }}</label>

                                <div class="col-md-6">
                                    <select class="form-group form-control" required name="student_no">
                                        <option value="">Select student name</option>
                                        @foreach($students as $student)
                                            <option value="{{ $student->student_no }}"> {{ $student->student_name }} {{ $student->student_surname }}</option>
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
                                    <input id="startdate" type="date" max="{{ date('Y-m-d', strtotime('-1 day')) }}" class="form-control @error('mobile_no') is-invalid @enderror" name="start_date" required>
                                    @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="enddate" class="col-md-4 col-form-label text-md-right">{{ __(' Time on bus to school') }}</label>

                                <div class="col-md-6">
                                    <input id="enddate" type="date" disabled class="form-control @error('mobile_no') is-invalid @enderror" name="" value="{{ date('Y-m-d') }}" required autocomplete="mobile-no">
                                    @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <label for="enddate" class="col-md-4 col-form-label text-md-right">{{ __(' Time off bus to school') }}</label>

                                <div class="col-md-6">
                                    <input id="enddate" type="text" disabled class="form-control @error('mobile_no') is-invalid @enderror" name="" value="absent" required autocomplete="mobile-no">
                                    @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <label for="enddate" class="col-md-4 col-form-label text-md-right">{{ __(' Time to school entrance') }}</label>

                                <div class="col-md-6">
                                    <input id="enddate" type="date" disabled class="form-control @error('mobile_no') is-invalid @enderror" name="" value="{{ date('Y-m-d') }}" required autocomplete="mobile-no">
                                    @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <label for="enddate" class="col-md-4 col-form-label text-md-right">{{ __(' Time exit school') }}</label>

                                <div class="col-md-6">
                                    <input id="enddate" type="text" disabled class="form-control @error('mobile_no') is-invalid @enderror" name="" value="absent" required autocomplete="mobile-no">
                                    @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <label for="enddate" class="col-md-4 col-form-label text-md-right">{{ __(' Time on bus to home') }}</label>

                                <div class="col-md-6">
                                    <input id="enddate" type="date" disabled class="form-control @error('mobile_no') is-invalid @enderror" name="" value="{{ date('Y-m-d') }}" required autocomplete="mobile-no">
                                    @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <label for="enddate" class="col-md-4 col-form-label text-md-right">{{ __(' Time off bus to home') }}</label>

                                <div class="col-md-6">
                                    <input id="enddate" type="text" disabled class="form-control @error('mobile_no') is-invalid @enderror" name="" value="absent" required autocomplete="mobile-no">
                                    @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-4 offset-md-2">
                                    <a href="{{ route('teacher-home') }}" class="btn btn-primary">
                                        {{ __('Next') }}
                                    </a>
                                </div>
                                <div class="col-md-4 offset-md-2">
                                    <a href="#" class="btn btn-primary">
                                        {{ __('Print') }}
                                    </a>
                                </div>
                            </div><br>
                            <div class="form-group row mb-0">
                                <div class="col-md-4 offset-md-8">
                                    <a href="{{ route('teacher-home') }}" class="btn btn-primary">
                                    {{ __('Back') }}
                                    </a>
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
