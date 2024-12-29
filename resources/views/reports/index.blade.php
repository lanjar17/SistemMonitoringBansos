@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Sistem Monitoring dan Evaluasi Program Bantuan Sosial</h1>
    <a href="/create" class="btn btn-primary">Buat Laporan Baru</a>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama Program</th>
                <th>Jumlah Penerima</th>
                <th>Provinsi</th>
                <th>Kabupaten</th>
                <th>Kecamatan</th>
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
                <td>{{ $report->district }}</td>
                <td>{{ $report->subdistrict }}</td>
                <td>{{ $report->status }}</td>
                <td>
                    <a href="/reports/{{ $report->id }}" class="btn btn-info">Lihat</a>
                    @if ($report->status === 'Pending')
                    <a href="/reports/{{ $report->id }}/edit" class="btn btn-warning">Edit</a>
                    <form action="/reports/{{ $report->id }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Hapus</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection