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
                'status' => "OK",
                'success' => true,
                'message' => "Vehicles found!",
                'data' => vehiclesResource::collection($validate)
            ];
            return response()->json($response);
        } catch (\Exception $exception) {

            $fail = [
                'status' => "ERROR",
                'success' => false,
                'message' => "Vehicles not found!"
            ];
            return response()->json($fail,404);
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
                'status' => "OK",
                'success' => true,
                'message' => "Vehicle details updated!",
                'data' => new vehiclesResource($vehicle)
            ];
            return response()->json($response);
        } catch (\Exception $exception) {

        $fail = [
            'status' => "ERROR",
            'success' => false,
            'message' => "Vehicle details could not be updated.",
            'data' => new vehiclesResource($request)
        ];
        return response()->json($fail,404);
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
                'status' => "OK",
                'success' => true,
                'message' => "Driver vehicle found!",
                'data' => vehiclesResource::collection(Vehicles::all()->where('drivers_id',$id))
            ];
            return response()->json($response);
        } catch (\Exception $exception)
        {
            $fail = [
                'status' => "ERROR",
                'success' => false,
                'message' => "Driver vehicle not found"
            ];
            return response()->json($fail,404);
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
                'status' => "OK",
                'success' => true,
                'message' => "Vehicle details updated!",
                'data' => $vehicle
            ];
            return response()->json($response);

        } catch (\Exception $exception) {

            $fail = [
                'status' => "ERROR",
                'success' => false,
                'message' => "Vehicle details could not be updated.",
                'data' => Vehicles::find($id)
            ];
            return response()->json($fail,404);
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
            'status' => "OK",
            'success' => true,
            'message' => "Vehicle deleted!"
            ];

            return response()->json($response);
        } catch (\Exception $exception) {

            $fail = [
                'status' => "ERROR",
                'success' => false,
                'message' => "Vehicle could not be deleted."
            ];
            return response()->json($fail,404);
        }
    }
}
