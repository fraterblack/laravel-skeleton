<?php

namespace Lpf\Interfaces\Shared\Http\Requests\General;

use Lpf\Support\Http\Request;

class SubscribeNewsletterRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email'
        ];
    }
}
