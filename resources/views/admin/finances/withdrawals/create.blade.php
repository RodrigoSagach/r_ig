@extends('layouts.admin')

@section('title', 'Novo Saque')

@section('breadcrumb')
    <li class="breadcrumb-link">
        <a href="{{ route('admin::finances::index') }}">Finanças</a>
    </li>
    <li class="breadcrumb-link">
        <a href="{{ route('admin.finance.withdrawals.index') }}">Saques</a>
    </li>
    <li class="breadcrumb-current-item">Criar Novo</li>
@endsection

@section('content')
    <div class="row">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-icon glyphicon glyphicon-plus"></span>
                <span class="panel-title">Novo Saque</span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <form action="{{ route('admin.finance.withdrawals.store') }}" method="POST">
                        {!! csrf_field() !!}

                        <input type="hidden" name="client_id" value="{{ $client->id }}">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">E-Mail</label>
                                <p class="form-control-static" id="email">{{ $client->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Descrição</label>
                                <input type="text" name="description" class="form-control" placeholder="Descrição do Saque" value="{{ old('description') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="account">Conta</label>
                                <div id="account">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="account" value="0" checked>
                                            Usar Conta do Perfil
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="account" value="1">
                                            Usar Campo Abaixo
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                <label for="email">Quantidade</label>
                                <div class="input-group">
                                    <input type="text" name="amount" id="amount" class="form-control" placeholder="Valor incluindo centavos" value="{{ old('amount') }}">
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
                            <div class="form-group{{ $errors->has('accountInfo') ? ' has-error' : '' }}">
                                <label for="accountInfo">Informações da Conta</label>
                                <textarea class="form-control" rows="11" id="accountInfo" name="accountInfo" disabled>
Titular:
Banco:
Agência:
Conta:
Tipo: Poupança / Corrente
--------------------------------- Ou ---------------------------------
Banco/Site:
E-Mail:
--------------------------------- Ou ---------------------------------
BitCoin Wallet:
                                </textarea>
                            @if ($errors->has('accountInfo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('accountInfo') }}</strong>
                                </span>
                            @endif
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

        $('input:radio[name=account]').on('change', function() {
            var $this = $(this);

            if ($this.is(':checked'))
            {
                if ($this.val() == '0')
                {
                    $('#accountInfo').prop('disabled', true);
                }
                else
                {
                    $('#accountInfo').prop('disabled', false);
                }
            }
        });
    </script>
@endsection