<?php

namespace App\Http\Controllers;

use App\Http\Requests\vehiclesRequest;
use App\Http\Resources\driverResource;
use App\Http\Resources\vehiclesCollection;
use App\Http\Resources\vehiclesResource;
use App\Models\Vehicles;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class vehiclesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return vehiclesResource::collection(Vehicles::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Vehicles  $vehicles
     * @return vehiclesResource
     */
    public function store(Request $request)
    {
//        $validated = $request->validate([
//            'license_plate_number' => 'required|unique:posts|max:255',
//            'vehicle_make' => 'required',
//            'vehicle_model' => ,
//            'year' => ,
//            'insured' => ,
//            'service_date' => ,
//            'capacity' => 'required'
//        ]);

        $vehicle = new Vehicles($request->all());
        $vehicle->save();
        return new vehiclesResource(Vehicles::find($vehicle->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicles  $vehicles
     * @return vehiclesResource
     */
    public function show($id)
    {
        return new vehiclesResource(Vehicles::find($id));
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
     * @return array
     */
    public function update(vehiclesRequest $request, Vehicles $vehicles)
    {
//        $validate = Validator::make($request)->
//        {
//        'license_plate_number' => 'required|unique:posts|max:255',
//        'vehicle_make' => 'required',
//        'vehicle_model' => 'required',
//        'year' => 'required',
//        'insured' => 'required',
//        'service_date' => 'required',
//        'capacity' => 'required'
//        } else {
//        'license_plate_number' => 'license plate number is required.',
//        'vehicle_make' => 'vehicle make is required.',
//        'vehicle_model' => 'vehicle model is required.',
//        'year' => 'year is required.',
//        'insured' => 'insurance is required',
//        'service_date' => 'service date is required.',
//        'capacity' => 'vehicle capacity is required.'
//    };

        if($request) {
            $vehicles->update($request->all());
            return [
                'status' => 'OK',
                'success' => true,
                'message' => 'Vehicle details updated!',
                'data' => new vehiclesResource($request)];
        } else {
            return [
                'status' => 'ERROR',
                'success' => false,
                'message' => 'Vehicle details could not be updated!',
                'data' => new vehiclesResource($request)];
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
            return[
                'status' => 'OK',
                'success' => true,
                'message' => 'Vehicle deleted!'];
        } else {
            return[
                'status' => 'ERROR',
                'success' => false,
                'message' => 'Vehicle could not be deleted.'];
        }
    }
}
