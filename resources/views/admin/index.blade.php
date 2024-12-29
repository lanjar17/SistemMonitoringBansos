@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="row mb-4">
        <div class="row-md-3">
            <a href="/admin/dashboard" class="btn btn-info">Dashboard Monitoring</a>
        </div>

    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama Program</th>
                <th>Jumlah Penerima</th>
                <th>Provinsi</th>
                <th>Kabupaten</th>
                <th>Kecamatan</th>
                <th>Tanggal Penyaluran</th>
                <th>Bukti Penyaluran</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
            <tr>
                <td>{{ $report->program_name }}</td>
                <td>{{ $report->recipient_count }}</td>
                <td>{{ $report->province }}</td>
                <td>{{ $report->disrict }}</td>
                <td>{{ $report->subdistrict }}</td>
                <td>{{ $report->distribution_date }}</td>
                <td>
                    @if ($report->proof)
                    <a href="{{ asset('storage/' . $report->proof) }}" target="_blank">Lihat Bukti</a>
                    @else
                    Tidak Ada Bukti
                    @endif
                </td>
                <td>{{ $report->status }}</td>
                <td>
                    @if ($report->status === 'Pending')
                    <form action="/admin/reports/{{ $report->id }}/approve" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-success">Approve</button>
                    </form>
                    <form action="/admin/reports/{{ $report->id }}/reject" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <input type="text" name="rejection_reason" placeholder="Alasan Ditolak" required>
                        <button class="btn btn-danger">Reject</button>
                    </form>
                    @else
                    <span>{{ $report->status }}</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection