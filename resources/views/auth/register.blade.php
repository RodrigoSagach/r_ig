@extends('layouts.basic')

@section('content')
    <div class="container" id="registration-form">
        <a href="{{ url('/') }}" class="login-logo"><img src="{{ asset('images/logo.png') }}"></a>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>Registration Form</h2>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="post">
                            {!! csrf_field() !!}

                            <div class="form-group mb-md{{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="col-xs-8 col-xs-offset-2">
                                    <input type="text" class="form-control" name="name" placeholder="First Name" value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group mb-md{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <div class="col-xs-8 col-xs-offset-2">
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group mb-md{{ $errors->has('username') ? ' has-error' : '' }}">
                                <div class="col-xs-8 col-xs-offset-2">
                                    <input type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}" required>
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group mb-md{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-xs-8 col-xs-offset-2">
                                    <input type="text" class="form-control" name="email" placeholder="E-Mail Address" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group mb-md{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-xs-8 col-xs-offset-2">
                                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group mb-md{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <div class="col-xs-8 col-xs-offset-2">
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="flex-sbtwn">
                                <span>
                                    Already Registered? <a href="{{ url('/login') }}" class="btn btn-default">Login</a>
                                </span>
                                <button type="submit" class="btn btn-primary btn-raised">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
