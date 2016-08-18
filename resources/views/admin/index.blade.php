@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('breadcrumb')
    <li class="active">
        <a href="/">Dashboard</a>
    </li>
@endsection

@section('content')
    <div class="page-heading">
        <h1>Dashboard<small>Project Stats</small></h1>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="info-tile info-tile-alt tile-danger">
                    <div class="info">
                        <div class="tile-heading"><span>Total Users</span></div>
                        <div class="tile-body "><span>{{ $stats->get('total.users') }}</span></div>
                    </div>
                    <div class="stats">
                        <div class="tile-content"><span class="icon" style="color: white;"><i class="material-icons">contacts</i></span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="info-tile info-tile-alt tile-indigo">
                    <div class="info">
                        <div class="tile-heading"><span>Investment Total</span></div>
                        <div class="tile-body"><span>{{ format_money($stats->get('total.investments')) }}</span></div>
                    </div>
                    <div class="stats">
                        <div class="tile-content"><span class="icon" style="color: white;"><i class="material-icons">equalizer</i></span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="info-tile info-tile-alt tile-primary">
                    <div class="info">
                        <div class="tile-heading"><span>Next Payment</span></div>
                        <div class="tile-body "><span>{{ format_money($stats->get('next_payment_value')) }}</span></div>
                    </div>
                    <div class="stats">
                        <div class="tile-content"><span class="icon" style="color: white;"><i class="material-icons">skip_next</i></span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
    </div>
    <div class="chute chute-center">
        <div class="row">
            <div class="col-sm-3 col-xl-4">
                <div class="panel panel-tile info-block info-block-bg-success">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-5 ph10 text-center">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="col-xs-7 pl35 prn text-center">
                                <h2>{{ $stats->get('total.quotas') }}</h2>
                                <h6>Cotas</h6>
                            </div>
                            <div class="col-sm-12">
                                <div class="info-block-stat">
                                    <span>Cotas Ativas</span>
                                    <span>{{ $stats->get('active.quotas') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xl-4">
                <div class="panel panel-tile info-block info-block-bg-info">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-5 ph10 text-center">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="col-xs-7 pl35 text-center">
                                <h2>{{ $stats->get('total.users') }}</h2>
                                <h6>Indicados</h6>
                            </div>
                            <div class="col-sm-12">
                                <div class="info-block-stat">
                                    <span>Membros Ativos</span>
                                    <span>{{ $stats->get('active.users') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 col-xl-4">
                <div class="panel panel-tile info-block info-block-bg-warning">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-5 ph10 text-center">
                                <i class="fa fa-money"></i>
                            </div>
                            <div class="col-xs-7 pl10 text-center">
                                <h2>{{ $stats->get('balance.total') }}</h2>
                                <h6>Saldo Total</h6>
                            </div>
                            <div class="col-sm-12">
                                <div class="info-block-stat">
                                    <span>Saldo Líquido</span>
                                    <span>{{ $stats->get('balance.withdrawable') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8">
                            <canvas id="siteChart"></canvas>
                            <script type="text/javascript">
                                var ctx = $('#siteChart');

                                var chart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: ['Total'],
                                        datasets: [{
                                            label: 'Usuários',
                                            data: [{{ $stats->get('total.users') }}]
                                        }, {
                                            label: 'Cotas',
                                            data: [{{ $stats->get('total.quotas') }}]
                                        }, {
                                            label: 'Saques',
                                            data: [{{ $stats->get('total.withdrawals') }}]
                                        }, {
                                            label: 'Pagamentos',
                                            data: [{{ $stats->get('total.earnings') }}]
                                        }]
                                    }
                                });
                            </script>
                        </div>
                        <div class="col-md-4">
                            <ul class="stat-boxes">
                                <li>
                                    <div class="left"></div>
                                    <div class="right">
                                        <strong>{{ $stats->get('total.users') }}</strong>
                                        Usuários
                                    </div>
                                </li>
                                <li>
                                    <div class="left"></div>
                                    <div class="right">
                                        <strong>{{ $stats->get('total.quotas') }}</strong>
                                        Cotas
                                    </div>
                                </li>
                                <li>
                                    <div class="left"></div>
                                    <div class="right">
                                        <strong>{{ $stats->get('total.withdrawals') }}</strong>
                                        Saques
                                    </div>
                                </li>
                                <li>
                                    <div class="left"></div>
                                    <div class="right">
                                        <strong>{{ $stats->get('total.earnings') }}</strong>
                                        Pagamentos
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
