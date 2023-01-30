<?php

namespace App\Http\Controllers;

use App\Http\Requests\vehiclesRequest;
use App\Http\Requests\StoreVehiclesRequest;
use App\Http\Resources\vehiclesResource;
use App\Models\Vehicles;
use http\Client\Request;
use Illuminate\Support\Facades\Validator;

class vehiclesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $validate = Vehicles::all();
            $response = [
                'message' => "Vehicles found!",
                'status' => "OK",
                'success' => true,
                'data' => vehiclesResource::collection($validate)
            ];
            return response()->json($response);
        } catch (\Exception $exception) {
            $fail = [
                'message' => "Vehicles not found!",
                'status' => "ERROR",
                'success' => false
            ];
            return response()->json($fail);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return array[]
     */
    public function create(vehiclesRequest $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Vehicles  $vehicles
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(vehiclesRequest $request)
    {
        $validated = $request->validate([
            'license_plate_number' => 'required',
            'vehicle_make' => 'required',
            'vehicle_model' => 'required',
            'year' => 'required',
            'insured' => 'required',
            'service_date' => 'required',
            'capacity' => 'required',
            'drivers_id' => 'required'
        ]);

        try
        {

            $vehicle = Vehicles::create($validated);

            $response = [
                'message' => "Vehicle details updated!",
                'status' => "OK",
                'success' => true,
                'data' => new vehiclesResource($vehicle)
            ];
            return response()->json($response);
        } catch (\Exception $exception) {
        $fail = [
            'message' => "Vehicle details could not be updated.",
            'status' => "ERROR",
            'success' => false,
            'data' => new vehiclesResource($request)
        ];
        return response()->json($fail);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicles  $vehicles
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $response = [
                'message' => "Driver vehicle found!",
                'status' => "OK",
                'success' => true,
                'data' => vehiclesResource::collection(Vehicles::all()->where('drivers_id',$id))
            ];
            return response()->json($response);
        } catch (\Exception $exception)
        {
            $fail = [
                'message' => "Driver vehicle not found",
                'status' => "ERROR",
                'success' => false
            ];
            return response()->json($fail);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Details  $details
     * @return \Illuminate\Http\Response
     */
    public function edit(Details $details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicles  $vehicles
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(vehiclesRequest $request, $id)
    {
        $rules = array(
            'license_plate_number' => 'required',
            'vehicle_make' => 'required',
            'vehicle_model' => 'required',
            'year' => 'required',
            'insured' => 'required',
            'service_date' => 'required',
            'capacity' => 'required');
        try {

        $validate = Validator::make($request->all(),$rules);
        $vehicle = Vehicles::query()->find($id);
        $vehicle->update($request->all());

            $response = [
                'message' => "Vehicle details updated!",
                'status' => "OK",
                'success' => true,
                'data' => $vehicle
            ];
            return response()->json($response);

        } catch (\Exception $exception) {
            $fail = [
                'message' => "Vehicle details could not be updated.",
                'status' => "ERROR",
                'success' => false,
                'data' => Vehicles::find($id)
            ];
            return response()->json($fail);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicles  $vehicles
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {

        $vehicles = Vehicles::find($id);
        $vehicles->delete();

        $response = [
            'message' => "Vehicle deleted!",
            'status' => "OK",
            'success' => true
            ];
            return response()->json($response);
        } catch (\Exception $exception) {
            $fail = [
                'message' => "Vehicle could not be deleted.",
                'status' => "ERROR",
                'success' => false
            ];
            return response()->json($fail);
        }
    }
}
