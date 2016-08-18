@extends('layouts.admin')

@section('title', 'Editar Usuário')

@section('breadcrumb')
    <li class="breadcrumb-link">
        <a href="{{ route('admin::users') }}">Usuários</a>
    </li>
    <li class="breadcrumb-current-item">Editar Usuário</li>
@endsection

@section('content')
    <style>
        .disabled-input {
            pointer-events: none;
            opacity: 0.4;
        }
    </style>
    <div class="row">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-icon glyphicon glyphicon-user"></span>
                <span class="panel-title">Editanto: {{ $usr->name }} &lt;{{ $usr->email }}&gt;</span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <form action="{{ route('admin::update_user', ['id' => $usr->id]) }}" method="POST">
                        {!! csrf_field() !!}

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Nome de Usuário</label>
                                <input type="text" name="username" value="{{ $usr->username }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">E-Mail</label>
                                <input type="email" name="email" value="{{ $usr->email }}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Nome</label>
                                <input type="text" name="name" value="{{ $usr->name }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="referred_by">Referência</label>
                                <input type="text" name="referred_by" value="{{ $usr->referred_by }}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="birthday">Data Nascimento</label>
                                <input type="text" name="birthday" value="{{ $usr->birthday }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_number">Número Celular</label>
                                <input type="text" name="phone_number" value="{{ $usr->phone_number }}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bank">Banco</label>
                                <input type="text" name="bank" value="{{ $usr->bank }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="agency">Agência</label>
                                <input type="text" name="agency" value="{{ $usr->agency }}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="account">Conta</label>
                                <input type="text" name="account" value="{{ $usr->account }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="account_type">Tipo de Conta</label>
                                <select name="account_type" class="form-control">
                                    <option value="0"{{ $usr->account_type == '0' ? ' selected=selected' : '' }}>Corrente</option>
                                    <option value="1"{{ $usr->account_type == '1' ? ' selected=selected' : '' }}>Poupança</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="holder">Titular</label>
                                <input type="text" name="holder" value="{{ $usr->holder }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="form-group">
                                <label for="password">Senha</label>
                                <input type="password" name="password" class="form-control">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="col-md-12">
                                <input type="checkbox" id="active" name="active" {{ $usr->active == true ? ' checked' : '' }}>
                                <label for="active">Ativo</label>
                            </div>
                            <div class="col-md-12">
                                <input type="checkbox" id="confirmed" name="confirmed" {{ $usr->confirmed == true ? ' checked' : '' }}>
                                <label for="confirmed">Confirmado</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation">Confirmar Senha</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <div>
                            <div class="col-md-12">
                                <label>
                                    <input type="checkbox" name="critical-change" id="critical-change">
                                    Editar informações abaixo
                                </label>
                            </div>
                            <div id="dontedit" class="disabled-input">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="balance">Saldo</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="balance" id="balance" value="{{ number_format($usr->balance, 2, '', '') }}">
                                            <span class="input-group-addon" id="balance-display">$ 0.0</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="e_funds">Saldo E-Commerce</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="e_funds" id="e_funds" value="{{ number_format($usr->e_funds, 2, '', '') }}">
                                            <span class="input-group-addon" id="e_funds-display">$ 0.0</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="balance">Número de Cotas</label>
                                        <input type="text" class="form-control" name="num_quotas" value="{{ $usr->num_quotas }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 col-md-offset-2">
                            <button type="submit" class="form-control btn btn-success btn-block">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#balance').on('change input paste keyup', function () {
            var $this = $(this);

            var re = /([0-9]*)([0-9]{2})$/;
            var val = $this.val().match(re);

            $('#balance-display').text($this.val().length < 2 ? '$ 0.00' : '$ ' + (typeof val[1] != "null" ? val[1] : 0 ) + '.' + val[2]);
        });
        $('#balance').trigger('input');

        $('#e_funds').on('change input paste keyup', function () {
            var $this = $(this);

            var re = /([0-9]*)([0-9]{2})$/;
            var val = $this.val().match(re);

            $('#e_funds-display').text($this.val().length < 2 ? '$ 0.00' : '$ ' + (typeof val[1] != "null" ? val[1] : 0 ) + '.' + val[2]);
        });
        $('#e_funds').trigger('input');

        $('#critical-change').bsAsk({
            placement: 'top',
            trigger: 'manual',
            title: 'Não modifique as informações abaixo!',
            content: {
                label: 'Você tem certeza que deseja modificar ?',
            },
            buttons: {
                callback: function (e, button) {
                    if (button == 'change') {
                        $('#dontedit').removeClass('disabled-input');
                    }
                },
                cancel: {
                    text: 'Cancelar',
                },
                change: {
                    type: 'btn-danger',
                    class: 'pull-right',
                    text: 'Modificar',
                }
            }
        });
        $('#critical-change').on('change', function () {
            if (this.checked) {
                $(this).popover('show');
            } else {
                $('#dontedit').addClass('disabled-input');
            }
        });
    </script>
@endsection