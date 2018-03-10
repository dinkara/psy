<?php

namespace App\Http\Requests;

//use App\Models\{{model}};
use Dinkara\DinkoApi\Http\Requests\ApiRequest;

class StoreCertificateRequest extends ApiRequest
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
	    'description' => 'required',
	    'url' => 'required|image|dimensions:min_width=300,min_height=300',

        ];
    }
}
