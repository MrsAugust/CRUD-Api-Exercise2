<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class detailsRequest extends FormRequest
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
                'home_address' => ['required'],
                'first_name' => ['required'],
                'last_name' => ['required'],
                'license_type' => ['required'],
                'last_trip_date' => ['required'],
            ];
        } else {
            return [
                'home_address' => ['sometimes','required'],
                'first_name' => ['sometimes','required'],
                'last_name' => ['sometimes','required'],
                'license_type' => ['sometimes','required'],
                'last_trip_date' => ['sometimes','required'],
            ];
        }
    }

    protected function prepareForValidation()
    {

    }
}
