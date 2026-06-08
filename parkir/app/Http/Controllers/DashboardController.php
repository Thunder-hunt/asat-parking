<?php

namespace App\Http\Controllers;

use App\Models\ParkirLocation;
use App\Models\ParkirTransaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the main dashboard with parking summary.
     */
    public function index()
    {
        // All parking locations with available capacity
        $locations = ParkirLocation::all();

        // Total active locations
        $totalLocations = $locations->count();

        // Transactions that entered today (regardless of exit status)
        $todayTransactions = ParkirTransaction::whereDate('masuk', Carbon::today())->count();

        // Vehicles currently parked (entered but not yet exited)
        $currentlyParked = ParkirTransaction::whereNull('keluar')->count();

        // Revenue from completed transactions today
        $todayRevenue = ParkirTransaction::whereDate('keluar', Carbon::today())
            ->whereNotNull('total_bayar')
            ->sum('total_bayar');

        // Last 10 transactions (completed + active)
        $recentTransactions = ParkirTransaction::with(['location', 'vehicleType'])
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        return view('pages.dashboard', compact(
            'locations',
            'totalLocations',
            'todayTransactions',
            'currentlyParked',
            'todayRevenue',
            'recentTransactions'
        ));
    }
}
