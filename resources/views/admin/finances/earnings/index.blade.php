@extends('layouts.admin')

@section('title', 'Ganhos')

@section('breadcrumb')
    <li class="breadcrumb-link">
        <a href="{{ route('admin::finances::index') }}">Finanças</a>
    </li>
    <li class="breadcrumb-current-item">Ganhos</li>
@endsection

@section('content')
    <div class="row">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-icon glyphicon glyphicon-copy"></span>
                <span class="panel-title">Ganhos</span>
            </div>
            <div class="panel-body">
                <div class="row clearfix">
                    <div class="pull-right">
                        <form class="navbar-form search-form square" role="search">
                            <div class="form-group">
                                <div class="input-group add-on">
                                    <input type="text" class="form-control" name="s" placeholder="Descrição">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>E-Mail</th>
                                <th>Quantiade</th>
                                <th>Ganho Em</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($earnings as $earning)
                            <tr>
                                <td>{{ $earning->id }}</td>
                                <td>{{ $earning->user->name }}</td>
                                <td>{{ $earning->user->email }}</td>
                                <td>{{ format_money($earning->amount) }}</td>
                                <td>{{ $earning->created_at->format('d/m/Y G:i') }}</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.finance.earnings.destroy', ['id' => $earning->id]) }}" class="form-horizontal" style="display: inline;">
                                        {!! csrf_field() !!}

                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" class="delete-form-confirmation nopadding btn btn-link">Apagar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="clearfix">
                        <div class="pull-right">
                            <nav>
                                {!! $earnings->links() !!}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $('.delete-form-confirmation').confirmation({
                btnOkLabel: 'Apagar',
                btnCancelClass: 'Cancelar',
                singleton: true,
                popout: true,
                title: 'Você tem Certeza?',
                placement: 'top',
                onConfirm: function (event, elem) {
                    $(elem).parent().submit();
                }
            });
        </script>
    </div>
@endsection
