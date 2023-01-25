<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVehiclesRequest extends FormRequest
{

    /**
     * @return true
     */
    public function authorize()
    {
        return true;
    }

    /**
     *
     * @return array
     */
    public function rules()
    {
        return [
            'license_plate_number' => ['required'],
            'vehicle_make' => ['required'],
            'vehicle_model' => ['required'],
            'year' => ['required'],
            'insured' => ['required'],
            'service_date' => ['required'],
            'capacity' => ['required'],
            'drivers_id' => ['required']
        ];
    }

    protected function prepareForValidation()
    {

    }
}
