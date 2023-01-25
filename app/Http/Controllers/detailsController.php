<?php

namespace App\Http\Controllers;

use App\Http\Requests\detailsRequest;
use App\Http\Resources\driverResource;
use App\Http\Resources\vehiclesResource;
use App\Models\Details;
use Illuminate\Http\Request;
use App\Http\Resources\detailsCollection;
use App\Http\Resources\detailsResource;
use Illuminate\Validation\Rule;

class detailsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return detailsCollection
     */
    public function index()
    {
        return new detailsCollection(Details::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $validated = $request->validate([
//            'title' => 'required|unique:posts|max:255',
//            'body' => 'required',
//        ]);
//        return [
//            'drivers_id' => ['required'],
//            'home_address' => ['required'],
//            'first_name' => ['required'],
//            'last_name' => ['required'],
//            'license_type' => ['required', Rule::in(['A', 'a', 'B', 'b', 'C', 'c', 'D', 'd'])],
//            'last_trip_date' => ['nullable']
//        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Details  $details
     * @return detailsResource
     */
    public function show($id)
    {
        return new detailsResource(Details::find($id));
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
     * @param  \App\Models\Details  $details
     * @return array
     */
    public function update(detailsRequest $request, Details $details, $id)
    {
        $details->update($request->all());

        if($request) {

            $detail = Details::find($id)->where('drivers_id',$id)->update($request->all());

            return response()->success('Driver information updated!',new detailsResource($detail));
        } else {
            return response()->error('Driver information could not be updated!',new detailsResource($request));
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
        $details = Details::find($id)->where('drivers_id',$id);
        $details->delete();

        if(!Details::find($id)->where('drivers_id',$id))
        {
            return response()->success('Driver information deleted');
        } else {
            return response()->error('Driver information could not be deleted.');
        }
    }
}
