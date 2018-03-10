<?php

namespace App\Http\Requests;

//use App\Models\{{model}};
use Dinkara\DinkoApi\Http\Requests\ApiRequest;
use App\Support\Enum\RatingOwners;

class UpdateRatingRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
	    'comment' => 'required',
	    'owner' => 'required|in:'.RatingOwners::stringify(),
	    'avg_rate' => 'required',

        ];
    }
}
