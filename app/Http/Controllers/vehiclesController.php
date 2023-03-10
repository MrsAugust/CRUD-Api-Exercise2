<?php

namespace App\Http\Controllers;

use App\Http\Requests\vehiclesRequest;
use App\Http\Requests\StoreVehiclesRequest;
use App\Http\Resources\vehiclesResource;
use App\Models\Drivers;
use App\Models\Vehicles;
use DateTimeInterface;
use DateTimeZone;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

class vehiclesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $validate = Vehicles::query();

            $make = $request::query('make');
            $service_date = $request::query('service_date');
            $age = $request::query('age');

            if ($make) {
                //get matching vehicle makes with specific string name
                $validate = $validate->where('vehicle_make', 'like', "%$make%")->get();
            }

            if($service_date) {
                //get vehicles with service dates younger than the provided argument
                $validate = $validate->where('service_date','<=',date($service_date).' 00:00:01')->get();
            }

            if($age) {
                //get vehicles released on a certain year
                $validate = $validate->where('year','=',now()->subYears($age))->get();
            }

//            if($validate->count()>25) {
//                $validate = $validate->paginate(25);
//            }

            $response = [
                'status' => "OK",
                'success' => true,
                'message' => "Vehicles found!",
                'data' => vehiclesResource::collection($validate)
            ];
            return response()->json($response);
        }
        catch (\Exception $exception) {

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

        $driver = Drivers::query()->find($validated['drivers_id']);

        try
        {

            $vehicle = Vehicles::create($validated);

            $response = [
                'status' => "OK",
                'success' => true,
                'message' => "Vehicle created!",
                'data' => new vehiclesResource($vehicle)
            ];
            return response()->json($response);
        } catch (\Exception $exception) {

        $fail = [
            'status' => "ERROR",
            'success' => false,
            'message' => "Vehicle could not be created.",
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
            $driver = Drivers::find($id);
            $response = [
                'status' => "OK",
                'success' => true,
                'message' => "Driver vehicle found!",
                'data' => vehiclesResource::collection(Vehicles::all()->where('drivers_id',$driver->id))
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
