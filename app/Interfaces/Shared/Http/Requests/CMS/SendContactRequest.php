<?php

namespace Lpf\Interfaces\Shared\Http\Requests\CMS;

use Lpf\Support\Http\Request;

class SendContactRequest extends Request
{
    public function attributes()
    {
        return [
            'telephone_1' => 'Telefone',
            'contact_recipient_id' => 'Destinatário'
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
            'contact_recipient_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'telephone_1' => 'required',
            'message' => 'required'
        ];
    }
}
