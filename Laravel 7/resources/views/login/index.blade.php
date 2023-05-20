@extends('layouts.layout')
@section('content')

<div class="card card-primary login">
    <div class="card-header bg-primary">Login</div>
    <div class="card-body">
        <div class="card-block">
            @if(Session::has('message_fail'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get('message_fail') }}
            </div>
            @endif
            @if(Session::has('message_ok'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get('message_ok') }}
            </div>
            @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <legend>Data</legend>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Enter username" required/>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required/>
                </div>
                <div class="text-center">
                    <p class="lead">
                        <button type="submit" class="btn btn-primary long-button"><i class="fa fa-arrow-circle-right icon" aria-hidden="true"></i>Login</button>
                    </p>
                </div>               
            </form>
        </div>
    </div>
</div>
 
@endsection