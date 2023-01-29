<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class driversRequest extends FormRequest
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
            'id_number' => ['required|digit'],
            'phone_number' => ['required|digit'],
        ];

    }

    protected function prepareForValidation()
    {

    }
}
