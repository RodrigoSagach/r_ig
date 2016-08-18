@extends('layouts.basic')

@section('title', 'Obrigado')

@section('content')
    <section id="content_wrapper">
        <div id="canvas-wrapper">
            <canvas id="demo-canvas"></canvas>
        </div>
        <section id="content">
            <div class="allcp-form theme-primary mw320" id="login">
                <div class="bg-primary mw600 text-center mb20 br3 pt15 pb10">
                    <img src="/images/logo.png" alt=""/>
                </div>
                <div class="panel mw320">
                    <div class="form-group">
                        <div class="alert alert-success" role="alert">
                            <strong>Conta Criada com Sucesso!</strong>
                            <p>
                                Porem é necessário a verificação do seu E-Mail.
                            </p>
                            <p>
                                Verifique seu E-Mail e siga as instuções no E-Mail de confirmação!
                            </p>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="pull-left">
                            <a href="{{ route('email::signup', ['id' => $user->id]) }}" class="btn btn-info">
                                <i class="fa fa-envelope"></i>
                                Reenviar E-Mail
                            </a>
                        </div>
                        <div class="pull-right">
                            <a href="{{ url('/login') }}" class="btn btn-info">
                                <i class="fa fa-sign-in"></i>
                                Entrar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection