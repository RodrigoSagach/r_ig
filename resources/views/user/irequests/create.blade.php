@extends('layouts.user')

@section('title', 'New Investment')

@section('breadcrumb')
    <li>
        <a href="/">Dashboard</a>
    </li>
    <li class="active">
        <a href="#">New Investment</a>
    </li>
@endsection

@section('content')
    <div class="page-heading">
        <h1>New Investment<small>Make a new Investment</small></h1>
    </div>
    <div class="container-fluid">
    @if (count($pendings) > 0)
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h3>Pending Investments</h3>
            <p>You have pending investments, wait until it is approved or <a href="#investNow">invest more now</a> if you like. <a href="#pendingInvestments">See pending investments</a></p>
        </div>
    @endif
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        Payment info, please send payment for one of following address.
                        <ul>
                            <li><strong>BitCoin:</strong>&nbsp;Coming soon</li>
                            <li><strong>Neteller:</strong>&nbsp;financial@investgroup.soccer</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default" id="investNow">
                    <div class="panel-body">
                        <div class="row">
                            <form method="POST" enctype="multipart/form-data">
                                {!! csrf_field() !!}

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">E-Mail</label>
                                        <p class="form-control-static">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                        <label for="amount">Amount (USD)</label>
                                        <input type="number" step="0.01" min="50" id="amount" name="amount" class="form-control" placeholder="Minium amount {{ format_money(50.0) }}" value="{{ old('amount') }}">
                                    @if ($errors->has('amount'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('amount') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group is-fileinput{{ $errors->has('receipt') ? ' has-error' : '' }}">
                                        <label for="receipt">Receipt (< 2MB)</label>
                                        <input type="file" id="receipt" name="receipt">
                                        <div class="input-group">
                                            <input type="text" readonly="" id="addon3" class="form-control" placeholder="Select a payment receipt image">
                                            <span class="input-group-btn input-group-sm">
                                                <button type="button" class="btn btn-fab btn-fab-mini">
                                                    <i class="material-icons">attach_file</i>
                                                </button>
                                            </span>
                                        </div>
                                    @if ($errors->has('receipt'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('receipt') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>

                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="form-control btn btn-primary btn-raised btn-block">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                        Invest
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default" id="pendingInvestments">
                    <div class="panel-heading">
                        <h2 class="panel-title">Pending Investments</h2>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Amount (USD)</th>
                                    <th>Receipt</th>
                                    <th>Pending Since</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($pendings as $pending)
                                <tr>
                                    <td>{{ $pending->id }}</td>
                                    <td>{{ format_money($pending->amount) }}</td>
                                    <td>
                                        <a href="{{ url('/investments', ['id' => $pending->id]) }}" class="open-popover">View</a>
                                    </td>
                                    <td>{{ $pending->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.open-popover').on('click', function (e) {
            e.preventDefault();

            var $self = $(this);

            window.open($self.attr('href'), '_blank', 'width=450,height=500,menubar=0,status=0,scrollbars=1,toolbar=0');
        });
    </script>
@endsection
