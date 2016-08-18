@extends('layouts.user')

@section('title', 'Investments')

@section('breadcrumb')
    <li>
        <a href="/">Dashboard</a>
    </li>
    <li class="active">
        <a href="/">Investments</a>
    </li>
@endsection

@section('content')
    <div class="page-heading">
        <h1>Investments<small>All investments you've done</small></h1>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>Amount (USD)</th>
                                    <th>Invested at</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($investments as $investment)
                                <tr>
                                    <td>{{ $investment->id }}</td>
                                    <td>{{ $investment->description }}</td>
                                    <td>{{ format_money($investment->amount) }}</td>
                                    <td>{{ $investment->created_at }}</td>
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
