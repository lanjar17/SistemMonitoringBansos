@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Laporan</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $report->program_name }}</h5>
            <p class="card-text">
                <strong>Jumlah Penerima:</strong> {{ $report->recipient_count }}<br>
                <strong>Provinsi:</strong> {{ $report->province }}<br>
                <strong>Kabupaten:</strong> {{ $report->district }}<br>
                <strong>Kecamatan:</strong> {{ $report->subdistrict }}<br>
                <strong>Tanggal Penyaluran:</strong> {{ $report->distribution_date }}<br>
                <strong>Status:</strong>
                <span class="badge bg-{{ $report->status === 'Approved' ? 'success' : ($report->status === 'Rejected' ? 'danger' : 'warning') }}">
                    {{ $report->status }}
                </span><br>
                @if ($report->status === 'Rejected')
                <strong>Rejection Reason:</strong> {{ $report->rejection_reason }}<br>
                @endif
                <strong>Catatan:</strong> {{ $report->notes }}
            </p>
            @if ($report->proof)
            <p>
                <strong>Bukti Penyaluran:</strong> <a href="{{ asset('storage/' . $report->proof) }}" target="_blank">Lihat File</a>
            </p>
            @endif
        </div>
    </div>
    <a href="/" class="btn btn-primary mt-3">Kembali</a>
</div>
@endsection