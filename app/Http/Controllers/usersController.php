<?php

namespace App\Http\Controllers;

use App\Http\Requests\driversRequest;
use App\Http\Resources\userResource;
use App\Models\Drivers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(driversRequest $request, $id)
    {
        $rules = array(
            'home_address' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'license_type' => 'required',
            'last_trip_date' => 'required');
        try {
            $validator = Validator::make($request->all(),$rules);
            $driver = Drivers::find($id);
            $user = User::find($driver->users_id);

            $driver->home_address=$request->home_address;
            $user->first_name=$request->first_name;
            $user->last_name=$request->last_name;
            $driver->license_type=$request->license_type;
            $driver->last_trip_date=$request->last_trip_date;
            $driver->update();
            $user->update();

            $response = [
                'status' => "OK",
                'success' => true,
                'message' => "Driver information updated!",
                'data' => new userResource($driver)
            ];
            return response()->json($response);

        } catch(\Exception $exception) {
            $fail = [
                'status' => "ERROR",
                'success' => false,
                'message' => "Driver account could not be updated!",
                'data' => new userResource(Drivers::find($id))
            ];
            return response()->json($fail,404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {

            $drivers = Drivers::find($id);
            $drivers->home_address=null;
            $drivers->last_trip_date=null;
            $drivers->license_type=null;
            $user = User::find($drivers->users_id);
            $user->first_name=null;
            $user->last_name=null;
            $drivers->update();
            $user->update();

            $response = [
                'status' => "OK",
                'success' => true,
                'message' => "Driver information deleted!"
            ];
            return response()->json($response);
        } catch (\Exception $exception) {

            $fail = [
                'status' => "ERROR",
                'success' => false,
                'message' => "Driver information could not be deleted."
            ];
            return response()->json($fail,404);
        }
    }
}
