@extends('layouts.admin')

@section('title', 'Novo Ganho')

@section('breadcrumb')
    <li class="breadcrumb-link">
        <a href="{{ route('admin::finances::index') }}">Finanças</a>
    </li>
    <li class="breadcrumb-link">
        <a href="{{ route('admin.finance.earnings.index') }}">Ganhos</a>
    </li>
    <li class="breadcrumb-current-item">Criar Novo</li>
@endsection

@section('content')
    <div class="row">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-icon glyphicon glyphicon-plus"></span>
                <span class="panel-title">Novo Ganho</span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <form action="{{ route('admin.finance.earnings.store') }}" method="POST">
                        {!! csrf_field() !!}

                        <input type="hidden" name="email" value="{{ $client->email }}">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">E-Mail</label>
                                <p>
                                    {{ $client->email }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                <label for="email">Quantidade</label>
                                <div class="input-group">
                                    <input type="text" name="amount" id="amount" class="form-control" placeholder="Valor incluindo centavos">
                                    <span class="input-group-addon" id="amount-display">$ 0,00</span>
                                </div>
                            </div>
                        @if ($errors->has('amount'))
                            <span class="help-block">
                                <strong>{{ $errors->first('amount') }}</strong>
                            </span>
                        @endif
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Descrição</label>
                                <input type="text" name="description" class="form-control" placeholder="Descrição do Ganho">
                            </div>
                        </div>

                        <div class="col-md-8 col-md-offset-2">
                            <button type="submit" class="form-control btn btn-success btn-block">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                Adicionar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#amount').on('change input paste keyup', function () {
            var $this = $(this);

            var re = /([0-9]*)([0-9]{2})$/;
            var val = $this.val().match(re);

            $('#amount-display').text($this.val().length < 2 ? '$ 0.00' : '$ ' + (typeof val[1] != "null" ? val[1] : 0 ) + '.' + val[2]);
        });
        $('#amount').trigger('input');
    </script>
@endsection