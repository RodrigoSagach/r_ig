@extends('layouts.basic')

@section('title', 'Withdrawal Request')

@section('content')
    <div class="container-fluid">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="post" id="acceptform">
                        {!! csrf_field() !!}

                        <table class="table table-hover">
                            <tr>
                                <th>Username:</th>
                                <td>{{ $request->user->username }}</td>
                            </tr>
                            <tr>
                                <th>Full Name:</th>
                                <td>{{ $request->user->name . ' ' . $request->user->last_name }}</td>
                            </tr>
                            <tr>
                                <th>E-Mail Address:</th>
                                <td>{{ $request->user->email }}</td>
                            </tr>
                            <tr>
                                <th>Payment Address:</th>
                                <td>{{ $request->account_type == 0 ? 'BitCoin' : 'Neteller' }}: {{ $request->account_value }}</td>
                            </tr>
                            <tr>
                                <th>Requested Value / Current Balance:</th>
                                <td>{{ format_money($request->amount) }} / <span{{ $request->user->balance < $request->amount ? ' style="color: red;"' : '' }}>{{ format_money($request->user->balance) }}</span> USD</td>
                            </tr>
                        </table>

                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" name="response" placeholder="Optional: Leave a comment"></textarea>
                        </div>

                        <div class="flex-sbtwn">
                            <button type="submit" name="status" value="2" class="btn btn-raised btn-warning">Reject</button>
                            <button type="submit" name="status" value="1" class="btn btn-raised btn-primary">Accept</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection