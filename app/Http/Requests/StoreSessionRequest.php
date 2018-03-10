<?php

namespace App\Http\Requests;

use Dinkara\DinkoApi\Http\Requests\ApiRequest;

class StoreSessionRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
	    'patient_id' => 'required',
	    'price' => 'required',
	    'start' => 'required',
	    'end' => 'required|after:start',
        ];
    }
}
