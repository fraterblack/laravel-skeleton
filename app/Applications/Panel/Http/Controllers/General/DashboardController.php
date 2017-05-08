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

    protected $request;

    function __construct(Request $request)
    {
        parent::__construct();

        $this->userHasPermission();

        $this->request = $request;

        view()->share('section', 'dashboard');
    }

    public function initial()
    {
        return $this->view('panel::general.dashboard.index', [
        ]);
    }
}