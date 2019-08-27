@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">{{ __('Parent Request for Report') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('create-request-report') }}" id="form" onsubmit="return checkDate();">
                            @csrf
                            <input type="hidden" value="{{$report_no}}" name="report_no" >
                            <div class="form-group row" id="signup-form">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Report Number') }}</label>

                                <div class="col-md-6">
                                    <Label>{{$report_no}}</Label>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="signup-form">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Parent Name and Surname') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value='{{ $parent["parent_surname"] }} {{ $parent["parent_name"] }}' readonly required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" id="signup-form">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Student No') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="student_no" value='{{ $parent["student_no"] }}' readonly required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row" id="signup-form">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Class Teacher Name and Surname') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="" value='{{ $teacher["teacher_name"] }} {{ $teacher["teacher_surname"] }}' readonly required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="startdate" class="col-md-4 col-form-label text-md-right">{{ __('Start Date') }}</label>

                                <div class="col-md-6">
                                    <input id="start-date" type="date" max="{{ date('Y-m-d', strtotime('-1 day')) }}" class="form-control @error('mobile_no') is-invalid @enderror" name="start_date" value="{{ old('email') }}" required autocomplete="mobile-no">

                                    @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="end-date" class="col-md-4 col-form-label text-md-right">{{ __('End Date ') }}</label>

                                <div class="col-md-6">
                                    <input id="end-date" type="date" max="{{ date('Y-m-d', strtotime('-1 day')) }}" class="form-control @error('mobile_no') is-invalid @enderror" name="end_date" value="{{ old('email') }}" required autocomplete="mobile-no">
                                    @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-6">
                                    <button type="submit" class="btn btn-primary" id="submit">
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
    <script>
        function checkDate() {
            const startDate =  document.getElementById('start-date').value;
            const endDate = document.getElementById('end-date').value;
            console.log(startDate, endDate);

            if (Date.parse(startDate) >= Date.parse(endDate)){
                alert('Start date must be greater than end date.');
                return false;
            }
            return true;
        }
    </script>
@endsection
