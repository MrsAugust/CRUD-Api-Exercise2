<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use function PHPUnit\Framework\assertContains;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

class StoreDriversRequest extends FormRequest
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
//        $license = ['A','a','B','b','C','c','D','d'];
        return [
            'id_number' => ['required'],
            'phone_number' => ['required'],
            'home_address' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'license_type' => ['required']
        ];
    }

    protected function prepareForValidation()
    {

    }

}
