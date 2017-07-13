<?php

namespace Lpf\Interfaces\Shared\Http\Requests\Users;

use Lpf\Support\Http\Request;

class UpdateMyAccountRequest extends Request
{
    public function attributes()
    {
        return [
            'redefine_password' => 'Redefinir senha'
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'bail|required',
            'email' => 'required|email|max:255|unique:users,email,' . $this->user()->id,
            'password' => 'required_with:redefine_password|confirmed|min:6',
        ];
    }
}
