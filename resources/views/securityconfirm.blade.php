@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <p>Your account has been succesfully verified. Somebody was trying to login to your account.</p> Click here to <a href="{{url('/login')}}">Reset your password</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
