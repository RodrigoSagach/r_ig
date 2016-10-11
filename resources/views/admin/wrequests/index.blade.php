@extends('layouts.admin')

@section('title', 'Pending Withdrawals')

@section('breadcrumb')
    <li>
        <a href="{{ admin_url('/') }}">Dashboard</a>
    </li>
    <li class="active">
        <a href="#">Pending Withdrawals</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
    <div class="page-heading">
        <h1>Pending Withdrawals<small>Manage the pending withdrawals</small></h1>
    </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="col-sm-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>E-Mail</th>
                                        <th>Account</th>
                                        <th>Amount (USD)</th>
                                        <th>Requested at</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($requests as $request)
                                    <tr data-wrequest="{{ $request->toJson() }}" class="row-data">
                                        <td>{{ $request->id }}</td>
                                        <td>{{ $request->user->name }}</td>
                                        <td>{{ $request->user->email }}</td>
                                        <td>
                                            {{ $request->account_type == 0 ? 'BitCoin' : 'Neteller' }}: <strong>{{ $request->account_value }}</strong>
                                        </td>
                                        <td>{{ format_money($request->amount) }}</td>
                                        <td>{{ $request->created_at }}</td>
                                        <td>{{ $request->status == 0 ? 'Pending' : ($request->status == 1 ? 'Approved' : 'Rejected') }}</td>
                                        <td>
                                            <a class="open-popover" href="{{ url('/admin/withdrawals/requests', ['id' => $request->id]) }}">Open</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-12">
                            <div class="flex-sbtwn">
                                <div></div>
                                <nav>
                                    {!! $requests->links() !!}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.open-popover').on('click', function (e) {
            e.preventDefault();

            var $self = $(this);

            var win = window.open($self.attr('href'), '_blank', 'width=650,height=500,menubar=0,status=0,scrollbars=1,toolbar=0');

            win.addEventListener('beforeunload', function () {
                setTimeout(function() {
                    location.reload();
                }, 500);
            });
        });
    </script>
@endsection
