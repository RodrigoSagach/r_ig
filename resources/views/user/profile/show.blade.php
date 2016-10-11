@extends('layouts.user')

@section('title', 'Profile')

@section('breadcrumb')
    <li>
        <a href="{{ user_url('') }}">Dashboard</a>
    </li>
        <li class="active">
        <a href="#">Profile</a>
    </li>
@endsection

@section('content')
    <div class="page-heading">
        <h1>Profile<small>Update Your Profile info</small></h1>
    </div>
    <div class="container-fluid">
    @if(session('update_payment_data'))
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4>Please update your payment info</h4>

            <p>
                In order to make withdrawals you must update your payment info below. 
            </p>
        </div>
    @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <form method="POST" enctype="multipart/form-data">
                                {!! csrf_field() !!}

                                <div class="col-sm-12">
                                    <div class="col-md-3">
                                        <div style="width: 128px; height: 128px;">
                                            <img src="{{ $user->profile_picture_url }}" style="width: auto; height: 100%; border-radius: 50%;" alt="avatar">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group{{ $errors->has('profile_picture') ? ' has-error' : '' }}">
                                            <input type="file" id="receipt" name="profile_picture">
                                            <div class="input-group">
                                                <input type="text" readonly="" id="addon3" class="form-control" placeholder="Change profile picture (&lt;2MB; .jpeg or .png)">
                                                <span class="input-group-btn input-group-sm">
                                                    <button type="button" class="btn btn-fab btn-fab-mini">
                                                        <i class="material-icons">attach_file</i>
                                                    </button>
                                                </span>
                                            </div>
                                        @if ($errors->has('profile_picture'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('profile_picture') }}</strong>
                                            </span>
                                        @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <p class="form-control-static">{{ $user->username }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">E-Mail</label>
                                        <p class="form-control-static">{{ $user->email }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" id="last_name" name="last_name" value="{{ $user->last_name }}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="account_type">Account Type</label>
                                        <select name="account_type" class="form-control">
                                            <option value="0"{{ $user->account_type == 0 ? ' selected=selected' : '' }}>BitCoin</option>
                                            <option value="1"{{ $user->account_type == 1 ? ' selected=selected' : '' }}>Neteller</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="account_value">Payment Address</label>
                                        <input type="text" name="account_value" value="{{ $user->account_value }}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation">Password Confirmation</label>
                                        <input type="password" name="password_confirmation" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="btn btn-raised btn-primary btn-block">Update Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
