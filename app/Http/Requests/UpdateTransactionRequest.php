<?php

namespace App\Http\Requests;

//use App\Models\{{model}};
use Dinkara\DinkoApi\Http\Requests\ApiRequest;
use App\Support\Enum\TransactionStatuses;

class UpdateTransactionRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
	    'amount' => 'required',
	    'comment' => 'required',

        ];
    }
}
