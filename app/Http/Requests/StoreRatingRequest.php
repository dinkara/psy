<?php

namespace App\Http\Requests;

//use App\Models\{{model}};
use Dinkara\DinkoApi\Http\Requests\ApiRequest;
use App\Support\Enum\RatingOwners;

class StoreRatingRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
	    'session_id' => 'required',
	    'comment' => 'required',
	    //'owner' => 'required|in:'.RatingOwners::stringify(),
	    //'avg_rate' => 'required',

        ];
    }
}
