<?php

namespace Lpf\Applications\Site\Http\Controllers\General;

use Illuminate\Http\Request;
use Lpf\Applications\Site\Http\Controllers\BaseController;

class DemoController extends BaseController
{
    protected $request;

    function __construct(Request $request)
    {
        parent::__construct();

        $this->request = $request;
    }

    public function initial()
    {
        $this->setSeo([
            'title' => 'Página Inicial do Site'
        ]);

        return $this->view('site::index', [
        ]);
    }
}