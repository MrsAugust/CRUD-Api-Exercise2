<?php

namespace App\Http\Controllers;

use App\Http\Requests\driversRequest;
use App\Http\Resources\driverResource;
use App\Http\Resources\driversResource;
use App\Models\Drivers;
use App\Models\User;
use Exception;

class driversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $validate = Drivers::all();
            $response = [
                'message' => "Drivers found!",
                'status' => "OK",
                'success' => true,
                'data' => driversResource::collection($validate)
                ];
            return response()->json($response);

            } catch (Exception $exception) {
            $fail = [
                'message' => "Drivers not found!",
                'status' => "ERROR",
                'success' => false
                ];
            return response()->json($fail);
        }

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
    public function store(driversRequest $request)
    {
        $validated = $request->validate([
            'id_number' => ['required'],
            'phone_number' => ['required'],
            'home_address' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'license_type' => ['required']
        ]);

        try {

            $user = User::create($validated);
            $driver = Drivers::create($validated,$user->id);
            $response = [
                'message' => "Driver information deleted",
                'status' => "OK",
                'success' => true,
                'data' => Drivers::find($driver->id)
                ];
            return response()->json($response);

        } catch (\Exception $exception)
        {
            $fail = [
                'message' => "Driver information could not be deleted.",
                'status' => "ERROR",
                'success' => false
            ];
            return response()->json($fail);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $response = [
                'message' => "Found driver account!",
                'status' => "OK",
                'success' => true,
                'data' => new driversResource(Drivers::find($id))
                ];
            return response()->json($response);

        } catch (\Exception $exception)
        {
            $fail = [
                'message' => "Could not find driver account!",
                'status' => "ERROR",
                'success' => false
                ];
            return response()->json($fail);
        }

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(driversRequest $request, $id)
    {
        $driver = Drivers::query()->find($id);
        try {

            $driver->update($request->all());
            $response = [
                'message' => "Driver account updated!",
                'status' => "OK",
                'success' => true,
                'data' => new driverResource($driver)
            ];
            return response()->json($response);


        } catch (Exception $exception) {
            $fail = [
                'message' => "Driver account could not be updated!",
                'status' => "ERROR",
                'success' => false,
                'data' => new driverResource($request)
            ];
            return response()->json($fail);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Details  $details
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {

            $drivers = Drivers::find($id);
            $drivers->delete();
            $response = [
                'message' => "Driver account deleted!",
                'status' => "OK",
                'success' => true
            ];
            return response()->json($response);

        } catch(Exception $exception) {
            $fail = [
                'message' => "Driver account could not be deleted.",
                'status' => "ERROR",
                'success' => false
            ];
            return response()->json($fail);
        }
    }
}
