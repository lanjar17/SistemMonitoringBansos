<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ReportController::class, 'index']);
Route::get('/create', [ReportController::class, 'create']);
Route::post('/reports', [ReportController::class, 'store']);
Route::get('/reports/{id}', [ReportController::class, 'show']);
Route::get('/reports/{id}/edit', [ReportController::class, 'edit']);
Route::put('/reports/{id}', [ReportController::class, 'update']);
Route::delete('/reports/{id}', [ReportController::class, 'destroy']);
Route::put('/reports/{id}/verify', [ReportController::class, 'verify']);

Route::get('/get-districts', [ReportController::class, 'getDistricts']);
Route::get('/get-subdistricts', [ReportController::class, 'getSubdistricts']);



//ADMIN
// Rute untuk admin
Route::prefix('admin')->group(function () {
    Route::get('/', [ReportController::class, 'adminIndex'])->name('admin.index'); // Halaman dashboard admin
    Route::get('/dashboard', [ReportController::class, 'dashboard'])->name('admin.dashboard'); // Dashboard monitoring
    Route::put('/reports/{id}/approve', [ReportController::class, 'approve'])->name('admin.reports.approve'); // Menyetujui laporan
    Route::put('/reports/{id}/reject', [ReportController::class, 'reject'])->name('admin.reports.reject'); // Menolak laporan dengan alasan
});
