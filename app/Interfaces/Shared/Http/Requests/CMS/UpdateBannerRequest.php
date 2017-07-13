<?php

namespace Lpf\Interfaces\Shared\Http\Requests\CMS;

use Lpf\Domains\CMS\BannerPlace;
use Lpf\Support\Http\Request;

class UpdateBannerRequest extends Request
{
    public function attributes()
    {
        return [
            'type' => 'Tipo do Banner',
            'banner_place_id' => 'Localização do Banner',
            'code' => 'Código HTML do Banner',
        ];
    }

    public function messages()
    {
        return [
            'code.required_if' => 'O campo Código HTML do Banner é obrigatório',
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
            'type' => 'required',
            'banner_place_id' => 'required',
            'code' => 'required_if:type,' . BannerPlace::TYPE_HTML,
        ];
    }
}
