<?php

namespace App\Http\Resources;

use App\Models\Vehicles;
use Illuminate\Http\Resources\Json\JsonResource;

class driversResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_number' => $this->id_number,
            'phone_number' => $this->phone_number,
            'details' => new detailsResource($this->details),
            'vehicles' => $this->vehicles = vehiclesResource::collection(Vehicles::all()->where('drivers_id',$this->id))
        ];
    }
}
