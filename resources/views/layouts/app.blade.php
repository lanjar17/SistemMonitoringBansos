<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Monitoring dan Evaluasi Program Bantuan Sosial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    <div class="container">
        @yield('content')
    </div>
</body>

<!-- <script>
    const programLabels = {
        !!json_encode($reportsByProgram - > pluck('program_name')) !!
    };
    const programData = {
        !!json_encode($reportsByProgram - > pluck('total')) !!
    };

    new Chart(document.getElementById('programChart'), {
        type: 'pie',
        data: {
            labels: programLabels,
            datasets: [{
                data: programData,
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#F44336']
            }]
        }
    });

    const regionLabels = {
        !!json_encode($reportsByRegion - > pluck('region')) !!
    };
    const regionData = {
        !!json_encode($reportsByRegion - > pluck('total')) !!
    };

    new Chart(document.getElementById('regionChart'), {
        type: 'bar',
        data: {
            labels: regionLabels,
            datasets: [{
                data: regionData,
                backgroundColor: '#36A2EB'
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script> -->

</html>