<?php

namespace App\Http\Controllers;

use App\Models\ParkirVehicleType;
use App\Http\Requests\StoreVehicleTypeRequest;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    /**
     * Display a listing of vehicle types (web view).
     */
    public function index()
    {
        $types = ParkirVehicleType::all();
        return view('pages.vehicle_type.index', compact('types'));
    }

    /**
     * Show the form for creating a new vehicle type.
     */
    public function create()
    {
        return view('pages.vehicle_type.create');
    }

    /**
     * Store a newly created vehicle type.
     */
    public function store(StoreVehicleTypeRequest $request)
    {
        $type = ParkirVehicleType::create($request->validated());

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Jenis kendaraan berhasil ditambahkan.', 'data' => $type], 201);
        }

        return redirect()->route('vehicle-type.index')->with('success', 'Jenis kendaraan berhasil ditambahkan.');
    }

    /**
     * Display the specified vehicle type (JSON).
     */
    public function show($id)
    {
        $type = ParkirVehicleType::find($id);

        if (!$type) {
            return response()->json(['success' => false, 'message' => 'Jenis kendaraan tidak ditemukan.'], 404);
        }

        return response()->json(['success' => true, 'data' => $type]);
    }

    /**
     * Show the form for editing the specified vehicle type.
     */
    public function edit($id)
    {
        $type = ParkirVehicleType::find($id);

        if (!$type) {
            return redirect()->route('vehicle-type.index')->with('error', 'Jenis kendaraan tidak ditemukan.');
        }

        return view('pages.vehicle_type.edit', compact('type'));
    }

    /**
     * Update the specified vehicle type.
     */
    public function update(StoreVehicleTypeRequest $request, $id)
    {
        $type = ParkirVehicleType::find($id);

        if (!$type) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Jenis kendaraan tidak ditemukan.'], 404);
            }
            return redirect()->route('vehicle-type.index')->with('error', 'Jenis kendaraan tidak ditemukan.');
        }

        $type->update($request->validated());

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Jenis kendaraan berhasil diperbarui.', 'data' => $type]);
        }

        return redirect()->route('vehicle-type.index')->with('success', 'Jenis kendaraan berhasil diperbarui.');
    }

    /**
     * Remove the specified vehicle type.
     */
    public function destroy(Request $request, $id)
    {
        $type = ParkirVehicleType::find($id);

        if (!$type) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Jenis kendaraan tidak ditemukan.'], 404);
            }
            return redirect()->route('vehicle-type.index')->with('error', 'Jenis kendaraan tidak ditemukan.');
        }

        $type->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Jenis kendaraan berhasil dihapus.']);
        }

        return redirect()->route('vehicle-type.index')->with('success', 'Jenis kendaraan berhasil dihapus.');
    }
}
