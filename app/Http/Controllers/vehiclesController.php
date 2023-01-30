<?php

namespace App\Http\Controllers;

use App\Http\Requests\vehiclesRequest;
use App\Http\Resources\driverResource;
use App\Http\Resources\vehiclesCollection;
use App\Http\Resources\vehiclesResource;
use App\Models\Vehicles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

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
            return response()->json(vehiclesResource::collection(Vehicles::all()));
        } catch (Throwable $e)
        {
            return response()->json($validate,404);
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
     * @return vehiclesResource
     */
    public function store(StoreVehiclesRequest $request)
    {
        $validated = $request->validate([
            'license_plate_number' => ['required'],
            'vehicle_make' => ['required'],
            'vehicle_model' => ['required'],
            'year' => ['required|digit|max:2023'],
            'insured' => ['sometimes','required'],
            'service_date' => ['sometimes','required'],
            'capacity' => ['required|digit|max:21']
        ]);

        if($validated)
        {
            $vehicle = new Vehicles($request->all());
            $vehicle->save();
            return response()->success('Vehicle details updated!',new vehiclesResource(Vehicles::find($vehicle->id)));
        } else {
            return response()->error('Vehicle details could not be updated.', $request);
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
            return response()->json(vehiclesResource::collection(Vehicles::all()->where('drivers_id',$id)));
        } catch (Throwable $throwable)
        {
            return response()->json([]);
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

        $validate = Validator::make($request->all(),$rules);
        $vehicle = Vehicles::query()->find($id);

        if($validate->fails() || !$vehicle) {
            return response()->json([],404);
        } else {
            $vehicle->update($request->all());
            return response()->json(new vehiclesResource($vehicle));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicles  $vehicles
     * @return array
     */
    public function destroy($id)
    {
        $vehicles = Vehicles::find($id);
        $vehicles->delete();

        if(!Vehicles::find($vehicles['id']))
        {
            return response()->success('Vehicle deleted!',[]);
        } else {
            return response()->error('Vehicle could not be deleted.',[]);
        }
    }
}
