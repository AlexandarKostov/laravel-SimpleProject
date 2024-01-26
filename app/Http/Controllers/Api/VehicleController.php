<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use http\Env\Response;
use Illuminate\Http\JsonResponse;


class VehicleController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $vehicle = Vehicle::all();
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => $vehicle
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleRequest $request): JsonResponse
    {
        $vehicle = Vehicle::create([
            'brand' => $request->input('brand'),
            'model' => $request->input('model'),
            'plate_number' => $request->input('plate_number'),
            'insurance_date' => $request->input('insurance_date'),
        ]);
        if ($vehicle) {
            return response()->json([
                'status' => 200,
                'success' => true,
                'data' => $vehicle
            ]);
        } else {
            return response()->json([
                'status' => 204,
                'success' => false,
                'data' => []
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle): JsonResponse
    {
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => new VehicleResource($vehicle)
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle): JsonResponse
    {
        if (!$vehicle->update()) {
            return response()->json([
                'status' => 200,
                'message' => 'Vehicle is not updated',
                'success' => false,
                'data' => []
            ]);
        }
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
    public function destroy(Vehicle $vehicle): JsonResponse
    {
        if (!$vehicle->delete()) {
            return response()->json([
                'status' => 200,
                'message' => 'Vehicle is not deleted',
                'success' => false,
                'data' => []
            ]);
        }
        return response()->json([
            'status' => 204,
            'message' => 'Vehicle deleted successfully',
            'success' => true,
            'data' => []
        ]);
    }
}
