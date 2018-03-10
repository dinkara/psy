<?php

namespace App\Http\Requests;

//use App\Models\{{model}};
use Dinkara\DinkoApi\Http\Requests\ApiRequest;
use App\Support\Enum\QuestionTypes;

class StoreQuestionRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
	    'text' => 'required',
	    'type' => 'required|in:'.QuestionTypes::stringify(),

        ];
    }
}
