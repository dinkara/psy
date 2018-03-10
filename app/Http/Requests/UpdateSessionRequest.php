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
	    'price' => 'required',
	    'start' => 'required',
	    'end' => 'required|after:start',
        ];
    }
}
