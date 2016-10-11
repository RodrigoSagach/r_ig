@extends('layouts.admin')

@section('title', 'Editing User')

@section('breadcrumb')
    <li>
        <a href="{{ admin_url('') }}">Dashboard</a>
    </li>
    <li class="active">
        <a href="#">Users</a>
    </li>
@endsection

@section('content')
    <div class="page-heading">
        <h1>Editing User<small>Editing: {{ $editUser->username }}</small></h1>
    </div>
    <div class="container-fluid">
    @if(session('updated'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4>Updated</h4>

            <p>
                User has been updated....
            </p>
        </div>
    @endif
        <div class="row">
            <div class="col-xs-12">
                <div class="panel">
                    <div class="panel-body">
                        <form method="post">
                            {!! csrf_field() !!}

                            <input type="hidden" name="_method" value="put">

                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" name="username" value="{{ $editUser->username }}" class="form-control">
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email">E-Mail Address</label>
                                    <input type="email" id="email" name="email" value="{{ $editUser->email }}" class="form-control">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" value="{{ $editUser->name }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" value="{{ $editUser->last_name }}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="account_type">Account Type</label>
                                    <select id="account_type" name="account_type" class="form-control">
                                        <option value="0"{{ $editUser->account_type == 0 ? ' selected' : '' }}>BitCoin</option>
                                        <option value="1"{{ $editUser->account_type == 1 ? ' selected' : '' }}>Neteller</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="account_value">Payment Address</label>
                                    <input type="text" id="account_value" name="account_value" value="{{ $editUser->account_value }}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password" class="form-control">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="checkbox block">
                                    <label for="confirmed">
                                        <input type="checkbox" id="confirmed" name="confirmed"{{ $editUser->confirmed == true ? ' checked' : '' }}>
                                        <span class="checkbox-material"></span>
                                        E-Mail Address Confirmed
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-block btn-raised btn-primary">Update User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>
@endsection