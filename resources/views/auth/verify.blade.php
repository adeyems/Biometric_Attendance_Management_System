@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>
                @if ($message = Session::get('error'))

                    <div class="alert alert-danger alert-block text-center">

                        <button type="button" class="close" data-dismiss="alert">×</button>

                        <strong class="text-center">{{ $message }}</strong>

                    </div>
                @endif

                @if ($message = Session::get('status'))

                    <div class="alert alert-success alert-block text-center">

                        <button type="button" class="close" data-dismiss="alert">×</button>

                        <strong class="text-center">{{ $message }}</strong>

                    </div>
                @endif
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
