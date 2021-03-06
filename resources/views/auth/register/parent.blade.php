@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">{{ __('Parent Registration') }}</div>

                    <div class="card-body">
                        @if ($messages = Session::get('error'))

                            @foreach($messages as $message)
                                <div class="alert alert-danger alert-block text-center">

                                    <button type="button" class="close" data-dismiss="alert">×</button>

                                    <strong class="text-center">{{ $message }}</strong>

                                </div>
                            @endforeach
                        @endif

                        @if ($message = Session::get('status'))

                            <div class="alert alert-success alert-block text-center">

                                <button type="button" class="close" data-dismiss="alert">×</button>

                                <strong class="text-center">{{ $message }}</strong>

                            </div>
                        @endif
                        <form method="POST" action="{{ route('createParent') }}" id="form" onsubmit="return false">
                            @csrf

                            <div class="form-group row" id="signup-form">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Parent Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Parent Surname') }}</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="signup-form">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Student No') }}</label>

                                <div class="col-md-6">
                                    <input id="student-no" type="text" class="form-control" name="student_no" value="{{ old('student_no') }}" required autocomplete="name" autofocus>
                                    <div id="username-msg"></div>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Home Address') }}</label>

                                <div class="col-md-6">
                                    <textarea  minlength="5" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="address"> {{ old('address') }}</textarea>

                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobile_no" class="col-md-4 col-form-label text-md-right">{{ __('Mobile No') }}</label>

                                <div class="col-md-6">
                                    <input id="mobile-no" type="text" class="form-control @error('mobile_no') is-invalid @enderror" minlength="13" maxlength="13" name="mobile_no" value="{{ old('mobile_no') ?? '+353'}}" required autocomplete="mobile-no">

                                    @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <input id="email"
                                           pattern="(\W|^)[\w.+\-]*@(gmail|yahoo|hotmail|outlook)\.com(\W|$)"
                                           title="Emails accepted are gmail.com, yahoo.com, outlook.com and hotmail.com"
                                           type="email" placeholder="email" class="form-control @error('email') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="username-msg">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           title="Password should contain at least an uppercase letter, a lower case letter, a number, a special character and a minimum length of 8"
                                           pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                                           class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" minlength="8">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Retype Password') }}</label>

                                <div class="col-md-6">
                                    <input id="confirm-password" minlength="8" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                                <div id="password-msg"></div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
