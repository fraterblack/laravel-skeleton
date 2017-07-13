<?php

namespace Lpf\Interfaces\Shared\Http\Requests\CMS;

use Lpf\Support\Http\Request;

class StoreBannerPlaceRequest extends Request
{
    public function attributes()
    {
        return [
            'display' => 'Mostrar',
            'limit' => 'Limite',
            'accepted_types' => 'Tipos Permitidos',
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
            'name' => 'required',
            'description' => 'required',
            'accepted_types' => 'required',
            'width' => 'required',
            'height' => 'required',
            'display' => 'required',
            'limit' => 'required',
        ];
    }
}
