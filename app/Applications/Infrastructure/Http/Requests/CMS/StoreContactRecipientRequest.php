<?php

namespace Lpf\Applications\Infrastructure\Http\Requests\CMS;

use Lpf\Support\Http\Request;

class StoreContactRecipientRequest extends Request
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
            'email' => 'required',
        ];
    }
}
