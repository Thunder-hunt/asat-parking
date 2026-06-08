<?php

namespace App\Http\Controllers;

use App\Models\ParkirLocation;
use App\Http\Requests\StoreLocationRequest;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the locations (web view).
     */
    public function index()
    {
        $locations = ParkirLocation::withCount('transactions')->get();
        return view('pages.location.index', compact('locations'));
    }

    /**
     * Show the form for creating a new location.
     */
    public function create()
    {
        return view('pages.location.create');
    }

    /**
     * Store a newly created location.
     * Accepts both web form and JSON API requests.
     */
    public function store(StoreLocationRequest $request)
    {
        $validated = $request->validated();

        // Initialize available capacity equal to max capacity upon creation
        $validated['available_motorcycle'] = $validated['max_motorcycle'];
        $validated['available_car']        = $validated['max_car'];
        $validated['available_other']      = $validated['max_other'];

        $location = ParkirLocation::create($validated);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Lokasi berhasil ditambahkan.', 'data' => $location], 201);
        }

        return redirect()->route('location.index')->with('success', "New Location was successfully saved!");
    }

    /**
     * Display the specified location (JSON).
     */
    public function show($id)
    {
        $location = ParkirLocation::find($id);

        if (!$location) {
            return response()->json(['success' => false, 'message' => 'Lokasi tidak ditemukan.'], 404);
        }

        return response()->json(['success' => true, 'data' => $location]);
    }

    /**
     * Show the form for editing the specified location.
     */
    public function edit($id)
    {
        $location = ParkirLocation::find($id);

        if (!$location) {
            return redirect()->route('location.index')->with('error', 'Location not found.');
        }

        return view('pages.location.edit', compact('location'));
    }

    /**
     * Update the specified location.
     */
    public function update(StoreLocationRequest $request, $id)
    {
        $location = ParkirLocation::find($id);

        if (!$location) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Lokasi tidak ditemukan.'], 404);
            }
            return redirect()->route('location.index')->with('error', 'Lokasi tidak ditemukan.');
        }

        $validated = $request->validated();

        // Preserve currently parked vehicles when adjusting max capacity
        $parkedMotorcycle = $location->max_motorcycle - $location->available_motorcycle;
        $parkedCar        = $location->max_car        - $location->available_car;
        $parkedOther      = $location->max_other      - $location->available_other;

        $validated['available_motorcycle'] = max(0, $validated['max_motorcycle'] - $parkedMotorcycle);
        $validated['available_car']        = max(0, $validated['max_car']        - $parkedCar);
        $validated['available_other']      = max(0, $validated['max_other']      - $parkedOther);

        $location->update($validated);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Lokasi berhasil diperbarui.', 'data' => $location]);
        }

        return redirect()->route('location.index')->with('success', "Location was successfully updated!");
    }

    /**
     * Remove the specified location.
     */
    public function destroy(Request $request, $id)
    {
        $location = ParkirLocation::find($id);

        if (!$location) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Lokasi tidak ditemukan.'], 404);
            }
            return redirect()->route('location.index')->with('error', 'Lokasi tidak ditemukan.');
        }

        $locationName = $location->location_name;
        $location->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Lokasi berhasil dihapus.']);
        }

        return redirect()->route('location.index')->with('success', "Location was successfully deleted!");
    }
}
