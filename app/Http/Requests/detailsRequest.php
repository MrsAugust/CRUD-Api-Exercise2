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
        return [
            'home_address' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'license_type' => ['required'],
            'last_trip_date' => ['required'],
        ];
    }

    protected function prepareForValidation()
    {

    }
}
