<?php

namespace Lpf\Applications\Infrastructure\Http\Requests\Users;

use Lpf\Support\Http\Request;

class StoreUserRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'bail|required',
            'email' => 'bail|required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ];
    }
}
