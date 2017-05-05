<?php

namespace Lpf\Support\Http;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class Request.
 */
class Request extends FormRequest
{
    protected $moneyRegex = "/^(\d{1,3}([,\s.']\d{3})*)\,\d{2}$/";

    public function authorize()
    {
        return true;
    }
}
