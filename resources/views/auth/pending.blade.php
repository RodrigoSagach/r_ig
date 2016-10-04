@extends('layouts.basic')

@section('title', 'Thank you')

@section('content')
    <div class="container">
        <a href="/" class="login-logo"><img src="{{ asset('images/logo.png') }}"></a>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>Confirm your email address</h2>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4>Sent confirmation Mail!</h4>
                            <p>
                                We sent to you a confirmation Mail.
                            </p>
                        </div>
                        <p>
                            Your registration is almost done, now you must confirm your email address, see your mail box for the confirmation email and follow instructions inside it.
                        </p>
                    </div>
                    <div class="panel-footer">
                        <div class="flex-sbtwn">
                            <a href="{{ url('/emails/resend/confirmation', ['username' => $newUser->username]) }}" class="btn btn-default">Resend</a>
                            <a href="{{ url('/login') }}" class="btn btn-primary btn-raised">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection