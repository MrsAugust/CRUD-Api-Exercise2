<?php

namespace App\Http\Resources;

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
            'vehicles' => [new vehiclesResource($this->vehicles)]
        ];
    }
}
