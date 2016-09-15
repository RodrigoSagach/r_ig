@extends('layouts.admin')

@section('title', 'Pending Investments')

@section('breadcrumb')
    <li>
        <a href="/">Dashboard</a>
    </li>
    <li class="active">
        <a href="#">Pending Investments</a>
    </li>
@endsection

@section('content')
    <div class="page-heading">
        <h1>Pending Investments<small>Manage the pending investments</small></h1>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-sm-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>E-Mail</th>
                                        <th>Amount (USD)</th>
                                        <th>Requested at</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($requests as $request)
                                    <tr>
                                        <td>{{ $request->id }}</td>
                                        <td>{{ $request->user->name }}</td>
                                        <td>{{ $request->user->email }}</td>
                                        <td>{{ format_money($request->amount) }}</td>
                                        <td>{{ $request->created_at }}</td>
                                        <td>{{ $request->status == 0 ? 'Pending' : ($request->status == 1 ? 'Approved' : 'Rejected') }}</td>
                                        <td>
                                            <a href="{{ url('investments/requests', ['id' => $request->id]) }}" data-toggle="request-popup">Open</a>
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
        $('[data-toggle=request-popup').on('click', function (e) {
            e.preventDefault();

            var $self = $(this);

            var win = window.open($self.attr('href'), '_blank', 'width=450,height=500,menubar=0,status=0,scrollbars=1,toolbar=0');

            win.addEventListener('beforeunload', function () {
                setTimeout(function() {
                    location.reload();
                }, 500);
            });
        });
    </script>
@endsection
