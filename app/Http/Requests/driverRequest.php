<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class driverRequest extends FormRequest
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
            'id_number' => ['required'],
            'phone_number' => ['required'],
        ];

    }

    protected function prepareForValidation()
    {

    }
}
