<canvas id="earningChart" width="500" height="350"></canvas>
<script type="text/javascript">
    var ctx = $('#earningChart');

    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total'],
            datasets: [{
                label: 'Total Sem Fazer Saques',
                data: [{{ $nwTotal }}],
                backgroundColor: 'rgba(0,255,0,0.5)'
            }, {
                label: 'Total Incluindo Saques (Apróx.)',
                data: [{{ $wwTotal }}],
                backgroundColor: 'rgba(0,0,255,0.5)'
            }, {
                label: 'Total Não Composto',
                data: [{{ $ncTotal }}],
                backgroundColor: 'rgba(255,0,0,0.5)'
            }]
        }
    });
</script>