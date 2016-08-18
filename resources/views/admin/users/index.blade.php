@extends('layouts.admin')

@section('title', 'Users')

@section('breadcrumb')
    <li>
        <a href="/">Dashboard</a>
    </li>
    <li class="active">
        <a href="/">Users</a>
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
                                            <th>Registered at</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $current)
                                        <tr data-user="{{ $current->toJson() }}" data-toggle="popover-data">
                                            <td>{{ $current->id }}</td>
                                            <td>{{ $current->username }}</td>
                                            <td>{{ $current->name }}</td>
                                            <td>{{ $current->email }}</td>
                                            <td>{{ $current->created_at }}</td>
                                            <td>
                                                <a href="{{ url('/user', ['id' => $current->id]) }}">Editar</a>
                                                |
                                                <a data-href="{{ url('/user', ['id' => $current->id]) }}" class="delete-confirmation">Apagar</a>
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
        $('[data-toggle=popover-data]').popover({
            container: 'body',
            content: function () {
                var data = $(this).data('user');

                $ul = $('<ul/>').addClass('list-group');

                $ul.append($('<li/>').addClass('list-group-item').html('<strong>Balance:</strong> ' + data.cpf));
                $ul.append($('<li/>').addClass('list-group-item').html('<strong>Invested:</strong> $ ' + parseFloat(data.balance).toFixed(2)));
                $ul.append($('<li/>').addClass('list-group-item').html('<strong>Earned:</strong> $ ' + parseFloat(data.e_funds).toFixed(2)));

                return $ul;
            },
            html: true,
            placement: 'top',
        });

        $('[data-toggle=popover-data]').hover(function () {
            $(this).popover('show');
        }, function () {
            $(this).popover('hide');
        });

        $('.delete-confirmation').confirmation({
            btnOkLabel: 'Apagar',
            btnCancelClass: 'Cancelar',
            singleton: true,
            popout: true,
            title: 'Você tem Certeza?',
            placement: 'top'
        });
    </script>
@endsection
