@extends('layouts.admin')

@section('title', 'Users')

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
        <h1>Users<small>Manage all users</small></h1>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div clas="row">
                            <div class="col-xs-12">
                                <div class="flex-sbtwn">
                                    <div></div>
                                    <form role="search">
                                        <div class="form-group addon">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="s" placeholder="Name or E-Mail">
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-default" style="padding: 0;">
                                                        <span class="icon"><i class="material-icons">search</i></span>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Username</th>
                                            <th>Name</th>
                                            <th>E-Mail</th>
                                            <th>Balance (USD)</th>
                                            <th>Registered at</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $current)
                                        <tr>
                                            <td>{{ $current->id }}</td>
                                            <td>{{ $current->username }}</td>
                                            <td>{{ $current->name }}</td>
                                            <td>{{ $current->email }}</td>
                                            <td>{{ format_money($current->balance) }}</td>
                                            <td>{{ $current->created_at }}</td>
                                            <td>
                                                <a href="{{ url('admin/users', ['id' => $current->id]) }}">Edit</a>
                                                |
                                                <a data-href="{{ url('admin/users', ['id' => $current->id]) }}" class="delete-confirmation">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-xs-12">
                                <div class="flex-sbtwn">
                                    <div></div>
                                    <nav>
                                        {!! $users->links() !!}
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.delete-confirmation').on('click', function (e) {
            e.preventDefault();

            $self = $(this);

            if (window.confirm('Are you sure want delete this user ?'))
            {
                $.post($self.data('href'), {
                    '_method': 'delete',
                    '_token': '{{ csrf_token() }}',
                }, function () {
                    location.reload();
                });
            }
        });
    </script>
@endsection
