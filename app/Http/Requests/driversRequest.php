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
        $method = $this->method();

        if($method == 'PUT')
        {
            return [
                'id_number' => ['required'],
                'phone_number' => ['required'],
            ];
        } else {
            return [
                'id_number' => ['sometimes', 'required'],
                'phone_number' => ['sometimes', 'required'],
            ];
        }
    }

    protected function prepareForValidation()
    {

    }
}
