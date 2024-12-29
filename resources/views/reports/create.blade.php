@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Laporan</h1>
    <form action="/reports" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="program_name" class="form-label">Nama Program</label>
            <select class="form-control" id="program_name" name="program_name" required>
                <option value="">Pilih Program</option>
                <option value="PKH">PKH</option>
                <option value="BLT">BLT</option>
                <option value="Bansos">Bansos</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="recipient_count" class="form-label">Jumlah Penerima</label>
            <input type="number" class="form-control" id="recipient_count" name="recipient_count" required>
        </div>
        <div class="mb-3">
            <label for="province" class="form-label">Provinsi</label>
            <select class="form-control" id="province" name="province" required>
                <option value="">Pilih Provinsi</option>
                @foreach ($provinces as $province => $districts)
                <option value="{{ $province }}">{{ $province }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="district" class="form-label">Kabupaten</label>
            <select class="form-control" id="district" name="district" required>
                <option value="">Pilih Kabupaten</option>
                @foreach ($provinces as $province => $districts)
                @foreach ($districts as $district => $subdistricts)
                <option value="{{ $district }}" data-province="{{ $province }}">{{ $district }}</option>
                @endforeach
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="subdistrict" class="form-label">Kecamatan</label>
            <select class="form-control" id="subdistrict" name="subdistrict" required>
                <option value="">Pilih Kecamatan</option>
                @foreach ($provinces as $province => $districts)
                @foreach ($districts as $district => $subdistricts)
                @foreach ($subdistricts as $subdistrict)
                <option value="{{ $subdistrict }}" data-district="{{ $district }}">{{ $subdistrict }}</option>
                @endforeach
                @endforeach
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="distribution_date" class="form-label">Tanggal Penyaluran</label>
            <input type="date" class="form-control" id="distribution_date" name="distribution_date" required>
        </div>
        <div class="mb-3">
            <label for="proof" class="form-label"> Bukti Penyaluran (JPG, PNG, PDF)</label>
            <input type="file" class="form-control" id="proof" name="proof">
        </div>
        <div class="mb-3">
            <label for="notes" class="form-label">Catatan Tambahan</label>
            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Tambah</button>
    </form>
</div>
@endsection