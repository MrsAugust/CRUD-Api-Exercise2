<?php

namespace App\Http\Controllers;

use App\Http\Requests\driversRequest;
use App\Http\Requests\StoreDriversRequest;
use App\Http\Resources\driverResource;
use App\Http\Resources\driversResource;
use App\Models\Details;
use App\Models\Drivers;

class driversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return driversResource::collection(Drivers::all());
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
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function store(StoreDriversRequest $request)
    {
        $data = $request->all();

        $driver = Drivers::create($request->all());
        $details = new Details($data);

        $details->drivers_id = $driver->id;
        $details->save();

        if(Drivers::find($driver->id) && Details::find()->where('drivers_id',$driver->id))
        {
            return response()->success('Driver information deleted',Drivers::find($driver->id));
        } else {
            return response()->error('Driver information could not be deleted.',[]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\
     * @return driversResource
     */
    public function show($id)
    {
        return new driversResource(Drivers::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Drivers $drivers
     * @return \Illuminate\Http\Response
     */
    public function edit(Drivers $drivers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Drivers  $drivers
     * @return array
     */
    public function update(driversRequest $request, Drivers $drivers)
    {
        $drivers->update($request->all());
        if($request) {
            return [
                'status' => 'OK',
                'success' => true,
                'message' => 'Driver account updated!',
                'data' => new driverResource($request)];
        } else {
            return [
                'status' => 'ERROR',
                'success' => false,
                'message' => 'Driver account could not be updated!',
                'data' => new driverResource($request)];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Details  $details
     * @return array
     */
    public function destroy($id)
    {
        $drivers = Drivers::find($id);
        $drivers->delete();

//        if(!Drivers::find($drivers['id']))
//        {
//            return[
//                'status' => 'OK',
//                'success' => true,
//                'message' => 'Driver account deleted!'];
//        } else {
//            return[
//                'status' => 'ERROR',
//                'success' => false,
//                'message' => 'Driver account could not be deleted.'];
//        }
    }
}
