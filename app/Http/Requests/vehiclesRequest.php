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
        $method = $this->method();

        if($method == 'PUT')
        {
            return [
                'license_plate_number' => ['required'],
                'vehicle_make' => ['required'],
                'vehicle_model' => ['required'],
                'year' => ['required'],
                'insured' => ['required'],
                'capacity' => ['required']
            ];
        } else {
            return [
                'license_plate_number' => ['sometimes','required'],
                'vehicle_make' => ['sometimes','required'],
                'vehicle_model' => ['sometimes','required'],
                'year' => ['sometimes','required'],
                'insured' => ['sometimes','required'],
                'capacity' => ['sometimes','required']
            ];
        }
    }

    protected function prepareForValidation()
    {

    }
}
