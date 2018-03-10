<?php

namespace App\Http\Requests;
use Dinkara\DinkoApi\Http\Requests\ApiRequest;
use App\Support\Enum\UserTypes;

class StoreUserRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $profileRequest = new StoreProfileRequest;
        
        return array_merge(
         [
            'email' => "required|email|max:255|unique:users",
            'password' => "required|confirmed|min:6",
            'type' => 'required|in:'.UserTypes::stringify(),
        ], $profileRequest->rules());
    }
}
