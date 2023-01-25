<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class detailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'home_address' => $this->home_address,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'license_type' => $this->license_type,
            'last_trip_date' => $this->last_trip_date
        ];
    }
}
