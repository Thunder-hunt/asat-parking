<?php

namespace App\Http\Controllers;

use App\Models\ParkirLocation;
use App\Models\ParkirTransaction;
use App\Models\ParkirVehicleType;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display the Location Report.
     */
    public function locationReport()
    {
        $locations = ParkirLocation::withCount(['transactions'])->get();

        // Calculate summaries
        $totalLocations = $locations->count();
        $totalMaxCapacity = $locations->sum(function ($loc) {
            return $loc->max_motorcycle + $loc->max_car + $loc->max_other;
        });
        $totalAvailable = $locations->sum(function ($loc) {
            return $loc->available_motorcycle + $loc->available_car + $loc->available_other;
        });
        $totalParked = $totalMaxCapacity - $totalAvailable;

        return view('pages.reports.location', compact('locations', 'totalLocations', 'totalMaxCapacity', 'totalAvailable', 'totalParked'));
    }

    /**
     * Display the Transaction Report with filters.
     */
    public function transactionReport(Request $request)
    {
        $locations = ParkirLocation::all();
        $vehicleTypes = ParkirVehicleType::all();

        // Build query
        $query = ParkirTransaction::with(['location', 'vehicleType']);

        // Filter by location
        if ($request->filled('location_id')) {
            $query->where('id_lokasi', $request->location_id);
        }

        // Filter by vehicle type
        if ($request->filled('vehicle_type_id')) {
            $query->where('id_jenis', $request->vehicle_type_id);
        }

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('masuk', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('masuk', '<=', $request->end_date);
        }

        // Filter by status (parked or completed/exited)
        if ($request->filled('status')) {
            if ($request->status === 'parked') {
                $query->whereNull('keluar');
            } elseif ($request->status === 'completed') {
                $query->whereNotNull('keluar');
            }
        }

        // Get matching transactions
        $transactions = $query->orderByDesc('masuk')->paginate(15)->withQueryString();

        // Calculate filtered stats
        $statsQuery = clone $query;
        $totalCount = $statsQuery->count();
        $completedCount = (clone $statsQuery)->whereNotNull('keluar')->count();
        $activeCount = $totalCount - $completedCount;
        $totalRevenue = (clone $statsQuery)->whereNotNull('total_bayar')->sum('total_bayar');

        return view('pages.reports.transaction', compact(
            'locations',
            'vehicleTypes',
            'transactions',
            'totalCount',
            'completedCount',
            'activeCount',
            'totalRevenue'
        ));
    }
}
