@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registration</div>

                <div class="panel-body">
                    <p>You have attempted to log into this account too many times. We have sent you an email with a link to change your password.</p>
                    @if(Auth::check())
                      {{Auth::logout()}}
                    @endif
                      <p>Please check your email and <a href="{{ route('login') }}">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
