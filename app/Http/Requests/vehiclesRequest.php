<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class vehiclesRequest extends FormRequest
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
            'capacity' => ['required']
        ];
    }

    protected function prepareForValidation()
    {

    }
}
