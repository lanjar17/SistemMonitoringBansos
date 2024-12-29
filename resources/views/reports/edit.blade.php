@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Report</h1>
    <form action="/reports/{{ $report->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="program_name" class="form-label">Program Name</label>
            <select class="form-control" id="program_name" name="program_name" required>
                <option value="">Select Program</option>
                <option value="PKH" {{ $report->program_name === 'PKH' ? 'selected' : '' }}>PKH</option>
                <option value="BLT" {{ $report->program_name === 'BLT' ? 'selected' : '' }}>BLT</option>
                <option value="Bansos" {{ $report->program_name === 'Bansos' ? 'selected' : '' }}>Bansos</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="recipient_count" class="form-label">Recipient Count</label>
            <input type="number" class="form-control" id="recipient_count" name="recipient_count" value="{{ $report->recipient_count }}" required>
        </div>
        <div class="mb-3">
            <label for="province" class="form-label">Province</label>
            <select class="form-control" id="province" name="province" required>
                <option value="">Select Province</option>
                @foreach ($provinces as $province => $districts)
                <option value="{{ $province }}" {{ $report->province === $province ? 'selected' : '' }}>{{ $province }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="district" class="form-label">District</label>
            <select class="form-control" id="district" name="district" required>
                <option value="">Select District</option>
                @foreach ($provinces as $province => $districts)
                @foreach ($districts as $district => $subdistricts)
                <option value="{{ $district }}" data-province="{{ $province }}" {{ $report->district === $district ? 'selected' : '' }}>{{ $district }}</option>
                @endforeach
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="subdistrict" class="form-label">Subdistrict</label>
            <select class="form-control" id="subdistrict" name="subdistrict" required>
                <option value="">Select Subdistrict</option>
                @foreach ($provinces as $province => $districts)
                @foreach ($districts as $district => $subdistricts)
                @foreach ($subdistricts as $subdistrict)
                <option value="{{ $subdistrict }}" data-district="{{ $district }}" {{ $report->subdistrict === $subdistrict ? 'selected' : '' }}>{{ $subdistrict }}</option>
                @endforeach
                @endforeach
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="distribution_date" class="form-label">Distribution Date</label>
            <input type="date" class="form-control" id="distribution_date" name="distribution_date" value="{{ $report->distribution_date }}" required>
        </div>
        <div class="mb-3">
            <label for="proof" class="form-label">Proof (JPG, PNG, PDF)</label>
            @if ($report->proof)
            <p>Current Proof: <a href="{{ asset('storage/' . $report->proof) }}" target="_blank">View File</a></p>
            @endif
            <input type="file" class="form-control" id="proof" name="proof">
        </div>
        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control" id="notes" name="notes" rows="3">{{ $report->notes }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection