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
                'status' => "OK",
                'success' => true,
                'message' => "Drivers found!",
                'data' => driversResource::collection($validate)
                ];
            return response()->json($response);

            } catch (Exception $exception) {
            $fail = [
                'status' => "ERROR",
                'success' => false,
                'message' => "Drivers not found!"
                ];
            return response()->json($fail,404);
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
                'status' => "OK",
                'success' => true,
                'message' => "Driver information deleted",
                'data' => Drivers::find($driver->id)
                ];
            return response()->json($response);

        } catch (\Exception $exception)
        {
            $fail = [
                'status' => "ERROR",
                'success' => false,
                'message' => "Driver information could not be deleted."
            ];
            return response()->json($fail,404);
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
                'status' => "OK",
                'success' => true,
                'message' => "Found driver account!",
                'data' => new driversResource(Drivers::find($id))
                ];
            return response()->json($response);

        } catch (\Exception $exception)
        {
            $fail = [
                'status' => "ERROR",
                'success' => false,
                'message' => "Could not find driver account!"
                ];
            return response()->json($fail,404);
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
                'status' => "OK",
                'success' => true,
                'message' => "Driver account updated!",
                'data' => new driverResource($driver)
            ];
            return response()->json($response);


        } catch (Exception $exception) {
            $fail = [
                'status' => "ERROR",
                'success' => false,
                'message' => "Driver account could not be updated!",
                'data' => new driverResource($request)
            ];
            return response()->json($fail,404);
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
                'status' => "OK",
                'success' => true,
                'message' => "Driver account deleted!"
            ];
            return response()->json($response);

        } catch(Exception $exception) {
            $fail = [
                'status' => "ERROR",
                'success' => false,
                'message' => "Driver account could not be deleted."
            ];
            return response()->json($fail,404);
        }
    }
}
