<?php

namespace App\Http\Requests;

//use App\Models\{{model}};
use Dinkara\DinkoApi\Http\Requests\ApiRequest;

class UpdateCompanyRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
	    'name' => 'required',
	    'address' => 'required',
	    'city' => 'required',
	    'country' => 'required',
	    'zip' => 'required',

        ];
    }
}
