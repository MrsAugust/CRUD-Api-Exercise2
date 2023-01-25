<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class vehiclesResource extends JsonResource
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
            'license_plate_number' => $this->license_plate_number,
            'vehicle_make' => $this->vehicle_make,
            'vehicle_model' => $this->vehicle_model,
            'year' => $this->year,
            'insured' => $this->insured,
            'service_date' => $this->service_date,
            'capacity' => $this->capacity
        ];
    }
}
