@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('breadcrumb')
    <li class="active">
        <a href="{{ admin_url('') }}">Dashboard</a>
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
                        <div class="tile-body"><span>{{ format_money($stats->get('invested')) }}</span></div>
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
                <div class="panel">
                    <div class="panel-body">
                        <div id="stats" style="height: 300px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var data = [
            ["Invested", {{ $stats->get('invested') }}],
            ["Paid", {{ $stats->get('paid') }}],
            ["Drawee", {{ $stats->get('drawee') }}],
        ];

        var plot = $.plot($("#stats"), [ data ], {
            series: {
                bars: {
                    show: true,
                    barWidth: 0.6,
                    align: "center"
                }
            },
            xaxis: {
                mode: "categories",
                tickLength: 0
            },
        });
    </script>
@endsection
