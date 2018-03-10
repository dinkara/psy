<?php

namespace App\Http\Requests;

//use App\Models\{{model}};
use Dinkara\DinkoApi\Http\Requests\ApiRequest;

class StoreDoctorRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
	    'company_id' => 'required',
	    'price' => 'required',
	    'duration' => 'required',
	    'available' => 'required',

        ];
    }
}
