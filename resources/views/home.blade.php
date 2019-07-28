@extends('layouts.app')

@section('title')
    <title>Dashboard</title>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Welcome {{ session()->get('user')[0]["name"]}} {{ session()->get('user')[0]["surname"]}}. You are logged in as a  {{  session()->get('role')[0] }}.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
