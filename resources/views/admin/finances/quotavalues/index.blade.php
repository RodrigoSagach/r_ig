@extends('layouts.admin')

@section('breadcrumb')
    <li class="breadcrumb-link">
        <a href="{{ route('admin::finances::index') }}">Finanças</a>
    </li>
    <li class="breadcrumb-current-item">Valores de Cota</li>
@endsection

@section('content')
    <div class="row">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-icon glyphicon glyphicon-plus"></span>
                <span class="panel-title">Valores de Cota</span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Quantiade</th>
                                <th>Criada Em</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($quotavalues as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ format_money($value->amount) }}</td>
                                <td>{{ $value->created_at->format('d/m/Y G:i') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="clearfix">
                        <div class="pull-right">
                            <nav>
                                {!! $quotavalues->links(); !!}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
