@extends('layouts.admin')

@section('title', 'Transaction History')

@section('breadcrumb')
    <li>
        <a href="{{ admin_url('') }}">Dashboard</a>
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
                    <div class="panel-heading">
                        <h4 class="panel-title">Filtering</h4>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal">
                            <div style="padding: 0 20px; display: flex; justify-content: space-around; align-items: center; align-content: center;">
                                <div style="flex-grow: 2;">
                                    <div class="form-group">
                                        <label>Type</label>
                                        <select class="form-control" name="type">
                                            <option value="all"{{ request()->input('type') == 'all' ? ' selected' : '' }}>All</option>
                                            <option value="earning"{{ request()->input('type') == 'earning' ? ' selected' : '' }}>Earning</option>
                                            <option value="investment"{{ request()->input('type') == 'investment' ? ' selected' : '' }}>Investment</option>
                                            <option value="withdrawal"{{ request()->input('type') == 'withdrawal' ? ' selected' : '' }}>Withdrawal</option>
                                        </select>
                                    </div>
                                </div>
                                <div style="flex-grow: 7;">
                                    <div style="display: flex; justify-content: space-around; align-items: center; align-content: center;">
                                        <div class="form-group">
                                            <label>Search for</label>
                                            <select class="form-control" name="for">
                                                <option value="name"{{ request()->input('for') == 'name' ? ' selected' : '' }}>Name</option>
                                                <option value="username"{{ request()->input('for') == 'username' ? ' selected' : '' }}>Username</option>
                                                <option value="email"{{ request()->input('for') == 'email' ? ' selected' : '' }}>E-Mail Address</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Search By</label>
                                            <select class="form-control" name="by">
                                                <option value="match"{{ request()->input('by') == 'match' ? ' selected' : '' }}>Exactly Match</option>
                                                <option value="like"{{ request()->input('by') == 'like' ? ' selected' : '' }}>Like</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Search Query</label>
                                            <input type="text" name="query" value="{{ request()->input('query') }}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div style="flex-grow: 3;">
                                    <button type="submit" class="btn btn-block btn-raised btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
