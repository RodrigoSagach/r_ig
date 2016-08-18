@extends('layouts.user')

@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="active">
        <a href="/">Dashboard</a>
    </li>
@endsection

@section('content')
    <div class="page-heading">
        <h1>Dashboard<small>User Stats</small></h1>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="info-tile info-tile-alt tile-indigo">
                    <div class="info">
                        <div class="tile-heading"><span>Investment Total</span></div>
                        <div class="tile-body"><span>{{ format_money($stats->get('total.vested')) }}</span></div>
                    </div>
                    <div class="stats">
                        <div class="tile-content"><span class="icon" style="color: white;"><i class="material-icons">equalizer</i></span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="info-tile info-tile-alt tile-danger">
                    <div class="info">
                        <div class="tile-heading"><span>Earned</span></div>
                        <div class="tile-body "><span>{{ format_money($stats->get('total.earned')) }}</span></div>
                    </div>
                    <div class="stats">
                        <div class="tile-content"><span class="icon" style="color: white;"><i class="material-icons">done_all</i></span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
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
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="info-tile info-tile-alt tile-success clearfix">
                    <div class="info">
                        <div class="tile-heading"><span>Balance</span></div>
                        <div class="tile-body "><span>{{ format_money($user->balance) }}</span></div>
                    </div>
                    <div class="stats">
                        <div class="tile-content"><span class="icon" style="color: white;"><i class="material-icons">account_balance</i></span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="stats" style="height: 300px"></div>
                        <p id="hoverdata" class="text-center">Mouse hovers at (Date: <span id="x">0</span>, Amount (USD): <span id="y">0</span>). <span id="clickdata"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var invs = [
        @foreach($investments as $inv)
            [{{ $inv->created_at->getTimestamp() }}, {{ $inv->amount }}],
        @endforeach
        ];

        var earns = [
        @foreach($earnings as $earn)
            [{{ $earn->created_at->getTimestamp() }}, {{ $earn->amount }}],
        @endforeach
        ];

        var plot = $.plot($("#stats"),
            [{ data: invs, label: "Investments" }, { data: earns, label: "Earnings" }],
            {
                series: {
                    shadowSize: 0,
                    lines: { 
                        show: true,
                        lineWidth: 2,
                    },
                    points: { show: true }
                },
                grid: {
                    labelMargin: 10,
                    hoverable: true,
                    clickable: true,
                    borderWidth: 1,
                    borderColor: '#f5f5f5'
                },
                legend: {
                    backgroundColor: '#fff'
                },
                yaxis: { min: -1.2, max: 1.2, tickColor: '#f5f5f5', font: {color: '#bdbdbd'}},
                xaxis: { tickColor: '#f5f5f5', font: {color: '#bdbdbd'}},
                colors: [Utility.getBrandColor('success'), Utility.getBrandColor('inverse')],
                tooltip: true,
                tooltipOpts: {
                    content: "Date: %x, Amount (USD): %y"
                }
            }
        );

        var previousPoint = null;
        $("#stats").bind("plothover", function (event, pos, item) {
            var date = new Date(pos.x * 1000);
            $("#x").text(date.toLocaleDateString());
            $("#y").text(pos.y);
        });

        $("#stats").bind("plotclick", function (event, pos, item) {
            if (item) {
                $("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
                plot.highlight(item.series, item.datapoint);
            }
        });
    </script>
@endsection
