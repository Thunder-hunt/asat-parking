<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;

// ── Dashboard / Landing Redirect ──────────────────────────────────────────────
Route::get('/', function () {
    return redirect()->route('location.index');
})->name('dashboard');

// ── Parking Locations (CRUD) ─────────────────────────────────────────────────
Route::resource('location', LocationController::class);
// Adds: location.index, location.store, location.show, location.update, location.destroy

// ── Vehicle Types (CRUD) ──────────────────────────────────────────────────────
Route::resource('vehicle-type', VehicleTypeController::class);
// Adds: vehicle-type.index, vehicle-type.store, vehicle-type.show, vehicle-type.update, vehicle-type.destroy

// ── Transactions ──────────────────────────────────────────────────────────────
Route::get('/transaction',          [TransactionController::class, 'index'])->name('transaction.index');
Route::post('/transaction/enter',   [TransactionController::class, 'enter'])->name('transaction.enter');
Route::post('/transaction/exit',    [TransactionController::class, 'exit'])->name('transaction.exit');
Route::get('/transaction/lookup',   [TransactionController::class, 'lookup'])->name('transaction.lookup');

// ── Reports ──────────────────────────────────────────────────────────────────
Route::get('/report/location', [ReportController::class, 'locationReport'])->name('report.location');
Route::get('/report/transaction', [ReportController::class, 'transactionReport'])->name('report.transaction');
