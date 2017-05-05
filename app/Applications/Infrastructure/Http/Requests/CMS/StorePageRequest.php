<?php

namespace Lpf\Applications\Infrastructure\Http\Requests\CMS;

use Lpf\Support\Http\Request;

class StorePageRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'text' => 'required',
        ];
    }
}
