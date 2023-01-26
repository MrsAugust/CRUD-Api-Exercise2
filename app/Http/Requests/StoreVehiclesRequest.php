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
//            'id' => ['required|digit'],
            'license_plate_number' => ['required'],
            'vehicle_make' => ['required'],
            'vehicle_model' => ['required'],
            'year' => ['required|digit|max:2023'],
            'insured' => ['sometimes','required'],
            'service_date' => ['sometimes','required'],
            'capacity' => ['required|digit|max:21']
        ];
    }

    protected function prepareForValidation()
    {

    }
}
