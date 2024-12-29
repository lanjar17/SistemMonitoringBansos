@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Monitoring</h1>
    <div class="row mb-4">
        <div class="row-md-3">
            <a href="/admin" class="btn btn-info">Verifikasi Laporan</a>
        </div>

    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Laporan</h5>
                    <h3>{{ $totalReports }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Laporan Approved</h5>
                    <h3>{{ $approvedReports }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5>Laporan Rejected</h5>
                    <h3>{{ $rejectedReports }}</h3>
                </div>
            </div>
        </div>
    </div>

    <h2>Jumlah penerima bantuan per program</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Program</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportsByProgram as $report)
            <tr>
                <td>{{ $report->program_name }}</td>
                <td>{{ $report->total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- <h2>Reports by Region</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Region</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportsByRegion as $report)
            <tr>
                <td>{{ $report->province }}</td>
                <td>{{ $report->total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table> -->
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Grafik penyaluran bantuan per wilayah</h2>
            <canvas id="statusChart" width="400" height="400"></canvas>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data for Status Chart
    const statusData = @json($statusCounts);
    const statusLabels = Object.keys(statusData);
    const statusCounts = Object.values(statusData);

    new Chart(document.getElementById('statusChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: statusLabels,
            datasets: [{
                label: 'Status Distribution',
                data: statusCounts,
                backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56'],
            }]
        }
    });

    // Data for Program Chart
    const programData = @json($programCounts);
    const programLabels = Object.keys(programData);
    const programCounts = Object.values(programData);

    new Chart(document.getElementById('programChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: programLabels,
            datasets: [{
                label: 'Reports by Program',
                data: programCounts,
                backgroundColor: '#4BC0C0',
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection