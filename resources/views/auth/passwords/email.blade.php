@extends('layouts.basic')

<!-- Main Content -->
@section('content')
    <div class="container">
        <a href="{{ url('/') }}" class="login-logo"><img src="assets/img/logo-dark.png"></a>
        @if (session('status'))
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <h2>Password Recovery</h2>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="{{ url('/password/email') }}" class="form-horizontal" id="email-form">
                            {!! csrf_field() !!}

                            <div class="form-group mb-n {{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <p>Enter your email to reset your password</p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">person</i>
                                        </span>
                                        <input type="email" name="email" class="form-control" placeholder="E-Mail Address" value="{{ old('email') }}">
                                    </div>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">
                        <div class="flex-sbtwn">
                            <a href="{{ url('/login') }}" class="btn btn-default">Go Back</a>
                            <a href="{{ url('/password/email') }}" class="btn btn-primary btn-raised" onclick="document.getElementById('email-form').submit(); return false;">Send Password Reset Link</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
