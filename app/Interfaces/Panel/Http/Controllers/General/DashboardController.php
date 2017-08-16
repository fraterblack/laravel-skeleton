<?php

namespace Lpf\Interfaces\Panel\Http\Controllers\General;

use Illuminate\Http\Request;
use Lpf\Interfaces\Panel\Http\Controllers\BaseController;

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

        view()->share('active_menu_item', 'general.dashboard');
    }

    public function initial()
    {
        return $this->view('panel::general.dashboard.index', [
        ]);
    }
}