@extends('layouts.admin')

@section('title', 'Finanças - ')

@section('breadcrumb')
    <a class="tip-bottom">Finanças</a>
@endsection

@section('content')
    <div class="row">
    @include('partials.sidebar')
        <div class="col-md-9">
            <canvas id="siteChart"></canvas>
            <script type="text/javascript">
                var ctx = $('#siteChart');

                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Total'],
                        datasets: [{
                            label: 'Ivestimentos',
                            data: [{{ $total_investments }}],
                            backgroundColor: 'rgba(0, 0, 255, 0.8)'
                        }, {
                            label: 'Pagamentos Semanais',
                            data: [{{ $total_payouts }}],
                            backgroundColor: 'rgba(255, 255, 0, 0.8)'
                        }, {
                            label: 'Saques',
                            data: [{{ $total_withdrawals }}],
                            backgroundColor: 'rgba(255, 0, 0, 0.8)'
                        }, {
                            label: 'Ganhos',
                            data: [{{ $total_earnings }}],
                            backgroundColor: 'rgba(0, 255, 0, 0.8)'
                        }]
                    }
                });
            </script>
        </div>
    </div>
@endsection