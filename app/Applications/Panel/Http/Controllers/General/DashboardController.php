<?php

namespace Lpf\Applications\Panel\Http\Controllers\General;

use Illuminate\Http\Request;
use Lpf\Applications\Panel\Http\Controllers\BaseController;

class DashboardController extends BaseController
{
    protected $request;

    function __construct(Request $request)
    {
        parent::__construct();

        $this->request = $request;

        $this->setSeo([ 'title' => 'Principais Estatísticas' ]);
        view()->share('section', 'dashboard');
    }

    public function initial()
    {
        return $this->view('panel::general.dashboard.index', [
        ]);
    }
}