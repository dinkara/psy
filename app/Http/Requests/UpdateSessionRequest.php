<?php

namespace App\Http\Requests;

use Dinkara\DinkoApi\Http\Requests\ApiRequest;

class UpdateSessionRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
	    'price' => 'required|numeric|regex:/^\d*(\.\d{1,2})?$/|min:10',
	    'start' => 'required|after:now',
	    'end' => 'required|after:start',
        ];
    }
}
