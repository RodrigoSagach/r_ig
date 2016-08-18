@extends('layouts.admin')

@section('breadcrumb')
    <li class="breadcrumb-link">
        <a href="{{ route('admin::finances::index') }}">Finanças</a>
    </li>
    <li class="breadcrumb-current-item">Cotas</li>
@endsection

@section('content')
    <div class="row">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-icon glyphicon glyphicon-share"></span>
                <span class="panel-title">Cotas</span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Texto</th>
                                <th>Quantiade</th>
                                <th>Criada Em</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($quotas as $quota)
                            <tr>
                                <td>{{ $quota->id }}</td>
                                <td>{{ $quota->text }}</td>
                                <td>{{ format_money($quota->amount) }}</td>
                                <td>{{ $quota->created_at->format('d/m/Y G:i') }}</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.finance.quotas.destroy', ['id' => $quota->id]) }}" class="form-horizontal" style="display: inline;">
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
                                {!! $quotas->links(); !!}
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
