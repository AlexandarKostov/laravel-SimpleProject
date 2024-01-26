<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class VehicleController extends Controller
{
    public function dashboard(): \Illuminate\View\View
    {
        return view('dashboard');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicle = Vehicle::all();
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => $vehicle
        ]);
    }

    public function create(): \Illuminate\View\View
    {
        return \view('vehicle.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleRequest $request)
    {
        $vehicle = Vehicle::create([
            'brand' => $request->input('brand'),
            'model' => $request->input('model'),
            'plate_number' => $request->input('plate_number'),
            'insurance_date' => $request->input('insurance_date'),
        ]);
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => $vehicle
        ]);
    }

    public function edit(Vehicle $vehicle): \Illuminate\View\View
    {
        return \view('vehicle.edit', compact('vehicle'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        $vehicle->update([
            'brand' => $request->input('brand'),
            'model' => $request->input('model'),
            'plate_number' => $request->input('plate_number'),
            'insurance_date' => $request->input('insurance_date'),
        ]);
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => new VehicleResource($vehicle)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        if ($vehicle->delete()) {
            return response()->json([
                'status' => 204,
                'message' => 'Vehicle deleted succesfully',
                'success' => true,
                'data' => []
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Vehicle is not deleted',
                'success' => false,
                'data' => []
            ]);
        }
    }

}
