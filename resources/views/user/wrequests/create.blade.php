@extends('layouts.user')

@section('title', 'Withdrawal')

@section('breadcrumb')
    <li>
        <a href="/">Dashboard</a>
    </li>
    <li class="active">
        <a href="/withdrawal/new">Withdrawal</a>
    </li>
@endsection

@section('content')
    <div class="page-heading">
        <h1>Withdrawal<small>Make a withdrawal to the profile's account</small></h1>
    </div>
    <div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4>Requested</h4>

            <p>
                Your request has been created, wait until it's approved.
            </p>
        </div>
    @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="flex-sbtwn">
                            <span></span>
                            <span>
                                Current Balance: <strong>{{ format_money($user->balance) }}</strong> USD
                            </span>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <form method="post">
                                {!! csrf_field() !!}

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="to-address">To</label>
                                        <p class="form-control-static" id="to-address">
                                            {{ $user->account_type == 0 ? 'BitCoin' : 'Neteller' }}: <strong>{{ $user->account_value }}</strong>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                        <label for="amount">Amount (USD)</label>
                                        <input type="number" step="0.01" min="50" name="amount" id="amount" class="form-control" placeholder="Minimum withdrawal amount is 50.00 USD" value="{{ old('amount') }}">
                                    @if ($errors->has('amount'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('amount') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>

                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="btn btn-raised btn-primary btn-block">Done</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="panel panel-default" id="pending">
                    <div class="panel-heading">
                        <h2 class="panel-title">Pending Withdrawals</h2>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Account</th>
                                    <th>Amount (USD)</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($pendings as $request)
                                <tr>
                                    <td>{{ $request->id }}</td>
                                    <td>{{ $request->account_type == 0 ? 'BitCoin' : 'Neteller' }}: {{ $request->account_value }}</td>
                                    <td>{{ format_money($request->amount) }}</td>
                                    <td>{{ $request->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
