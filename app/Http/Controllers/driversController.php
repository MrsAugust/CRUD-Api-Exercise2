<?php

namespace App\Http\Controllers;

use App\Http\Requests\driversRequest;
use App\Http\Requests\StoreDriversRequest;
use App\Http\Resources\driverResource;
use App\Http\Resources\driversResource;
use App\Models\Details;
use App\Models\Drivers;
use App\Models\User;
use Exception as e;
use http\Exception\RuntimeException;
use Illuminate\Validation\Validator;
use Throwable;

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
            return response()->json(driversResource::collection($validate));
        } catch (Throwable $e)
        {
            return response()->json($validate,404);
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

        if ($validated) {
            $user = User::create($validated);
            $driver = Drivers::create($validated,$user->id);
            return response()->success('Driver information deleted', Drivers::find($driver->id));

        } else {
            return response()->error('Driver information could not be deleted.', []);
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
            return response()->json(new driversResource(Drivers::find($id)));

        } catch (Throwable $throwable)
        {
            return response()->json([]);
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
     * @return array
     */
    public function update(driversRequest $request, $id)
    {
        $driver = Drivers::query()->find($id);
        if($driver) {
            $driver->update($request->all());
            return response()->success('Driver account updated!',new driverResource($driver));
        } else {
            return response()->error('Driver account could not be updated!',new driverResource($request));
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

        if(!Drivers::find($drivers['id']))
        {
            return response()->success('Driver account deleted!',[]);
        } else {
            return response()->error('Driver account could not be deleted.',[]);
        }
    }
}
