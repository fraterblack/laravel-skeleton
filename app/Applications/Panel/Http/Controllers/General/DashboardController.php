<?php

namespace Lpf\Applications\Panel\Http\Controllers\General;

use Illuminate\Http\Request;
use Lpf\Applications\Panel\Http\Controllers\BaseController;

class DashboardController extends BaseController
{
    /**
     * ACL Permission name
     * @var array|null
     */
    protected $requiredPermissions = null;

    /**
     * Page name
     * @var string
     */
    protected $pageName = 'Painel Administrativo';

    protected $request;

    function __construct(Request $request)
    {
        parent::__construct();

        $this->request = $request;

        view()->share('section', 'dashboard');
    }

    public function initial()
    {
        return $this->view('panel::general.dashboard.index', [
        ]);
    }
}