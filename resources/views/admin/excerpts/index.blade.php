@extends('layouts.admin')

@section('title', 'Transaction History')

@section('breadcrumb')
    <li>
        <a href="/">Dashboard</a>
    </li>
    <li class="active">
        <a href="#">Transaction History</a>
    </li>
@endsection

@section('content')
    <div class="page-heading">
        <h1>Transaction History<small>View all Transaction History</small></h1>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-xs-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th>Amount (USD)</th>
                                        <th>Transaction Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($excerpts as $excerpt)
                                    <tr>
                                        <td>{{ $excerpt->id }}</td>
                                        <td>{{ $excerpt->user->username }}</td>
                                        <td>{{ excerpt_type($excerpt->type) }}</td>
                                        <td>{{ $excerpt->description }}</td>
                                        <td>{{ format_money($excerpt->amount) }}</td>
                                        <td>{{ $excerpt->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-xs-12">
                            <div class="flex-sbtwn">
                                <div></div>
                                <nav>
                                    {!! $excerpts->links(); !!}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>            
    </div>
@endsection
