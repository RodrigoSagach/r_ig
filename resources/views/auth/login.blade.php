@extends('layouts.basic')

@section('content')
    <div class="container" id="login-form">
        <a href="/" class="login-logo"><img src="{{ asset('images/logo-dark.png') }}"></a>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>Login</h2>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" id="validate-form" method="post">
                            {!! csrf_field() !!}

                            <div class="form-group mb-md{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="ti ti-user"></i>
                                        </span>
                                        <input type="text" name="email" class="form-control" placeholder="E-Mail Address" value="{{ old('email') }}" data-parsley-minlength="6" placeholder="At least 6 characters" required autofocus>
                                    </div>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="form-group mb-md{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="ti ti-key"></i>
                                        </span>
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="form-group mb-n">
                                <div class="col-xs-12">
                                    <a href="{{ url('/password/reset') }}" class="pull-left">Forgot password?</a>
                                    <div class="checkbox-inline icheck pull-right p-n">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="remember"> Remeber me</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">
                        <div class="flex-sbtwn">
                            <a href="/register" class="btn btn-default">Register</a>
                            <a href="/login" class="btn btn-primary btn-raised" onclick="document.getElementById('validate-form').submit(); return false;">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
