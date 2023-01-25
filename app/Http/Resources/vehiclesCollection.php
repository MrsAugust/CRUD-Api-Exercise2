<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
class vehiclesCollection extends ResourceCollection
{
    public function toArray($request)
    {
        $array = parent::toArray($request);
        $array['drivers_id'] = $this->drivers_id->only('id', 'license_plate_number', 'vehicle_make',
            'vehicle_model', 'year', 'insured', 'service_date', 'capacity');
        return $array;
    }
}
