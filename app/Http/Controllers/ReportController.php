<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::all();
        return view('reports.index', compact('reports'));
    }


    public function create()
    {
        $provinces = [
            'Provinsi A' => [
                'Kabupaten A1' => ['Kecamatan A1-1', 'Kecamatan A1-2'],
                'Kabupaten A2' => ['Kecamatan A2-1', 'Kecamatan A2-2']
            ],
            'Provinsi B' => [
                'Kabupaten B1' => ['Kecamatan B1-1', 'Kecamatan B1-2'],
                'Kabupaten B2' => ['Kecamatan B2-1', 'Kecamatan B2-2']
            ],
            'Provinsi C' => [
                'Kabupaten C1' => ['Kecamatan C1-1', 'Kecamatan C1-2'],
                'Kabupaten C2' => ['Kecamatan C2-1', 'Kecamatan C2-2']
            ]
        ];

        return view('reports.create', compact('provinces'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_name' => 'required|string',
            'recipient_count' => 'required|integer',
            'province' => 'required|string',
            'district' => 'required|string',
            'subdistrict' => 'required|string',
            'distribution_date' => 'required|date',
            'proof' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'notes' => 'nullable|string',
        ]);

        $proofPath = $request->file('proof')?->store('proofs', 'public');

        Report::create(array_merge($validated, ['proof' => $proofPath]));

        return redirect('/')->with('success', 'Report submitted successfully.');
    }

    public function show($id)
    {
        $report = Report::findOrFail($id);
        return view('reports.view', compact('report'));
    }

    public function edit($id)
    {
        $report = Report::findOrFail($id);
        $provinces = [
            'Provinsi A' => [
                'Kabupaten A1' => ['Kecamatan A1-1', 'Kecamatan A1-2'],
                'Kabupaten A2' => ['Kecamatan A2-1', 'Kecamatan A2-2']
            ],
            'Provinsi B' => [
                'Kabupaten B1' => ['Kecamatan B1-1', 'Kecamatan B1-2'],
                'Kabupaten B2' => ['Kecamatan B2-1', 'Kecamatan B2-2']
            ],
            'Provinsi C' => [
                'Kabupaten C1' => ['Kecamatan C1-1', 'Kecamatan C1-2'],
                'Kabupaten C2' => ['Kecamatan C2-1', 'Kecamatan C2-2']
            ]
        ];

        return view('reports.edit', compact('report', 'provinces'));
    }

    public function update(Request $request, $id)
    {
        $report = Report::findOrFail($id);

        $validated = $request->validate([
            'program_name' => 'required|string',
            'recipient_count' => 'required|integer',
            'province' => 'required|string',
            'district' => 'required|string',
            'subdistrict' => 'required|string',
            'distribution_date' => 'required|date',
            'proof' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'notes' => 'nullable|string',
        ]);

        if ($request->hasFile('proof')) {
            if ($report->proof) {
                Storage::delete('public/' . $report->proof);
            }
            $validated['proof'] = $request->file('proof')->store('proofs', 'public');
        }

        $report->update($validated);

        return redirect('/')->with('success', 'Report updated successfully.');
    }



    public function destroy($id)
    {
        $report = Report::findOrFail($id);

        if ($report->proof) {
            Storage::delete('public/' . $report->proof);
        }

        $report->delete();

        return redirect('/')->with('success', 'Report deleted successfully.');
    }


    public function verify(Request $request, $id)
    {
        $report = Report::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:Approved,Rejected',
            'rejection_reason' => 'required_if:status,Rejected|string',
        ]);

        $report->update($validated);

        return redirect('/')->with('success', 'Report status updated successfully.');
    }

    //ADMIN PUSAT

    public function dashboard()
    {
        $totalReports = Report::count();
        $approvedReports = Report::where('status', 'Approved')->count();
        $rejectedReports = Report::where('status', 'Rejected')->count();

        $statusCounts = Report::selectRaw('status, COUNT(*) as count')
        ->groupBy('status')
        ->pluck('count', 'status');

        $programCounts = Report::selectRaw('program_name, COUNT(*) as count')
        ->groupBy('program_name')
        ->pluck('count', 'program_name');

        $reportsByProgram = Report::select('program_name')
        ->selectRaw('COUNT(*) as total')
        ->groupBy('program_name')
        ->get();

        $reportsByRegion = Report::select('province')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('province')
            ->get();

        return view('admin.dashboard', compact(
            'totalReports',
            'approvedReports',
            'rejectedReports',
            'reportsByProgram',
            'reportsByRegion',
            'statusCounts',
            'programCounts'
        ));
    }

    public function adminIndex()
    {
        $reports = Report::orderBy('created_at', 'desc')->get();
        return view('admin.index', compact('reports'));
    }

    public function approve($id)
    {
        $report = Report::findOrFail($id);
        $report->update(['status' => 'Approved']);
        return redirect('/admin')->with('success', 'Report approved successfully.');
    }

    public function reject(Request $request, $id)
    {
        $report = Report::findOrFail($id);

        $validated = $request->validate([
            'rejection_reason' => 'required|string',
        ]);

        $report->update([
            'status' => 'Rejected',
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        return redirect('/admin')->with('success', 'Report rejected successfully.');
    }

}
