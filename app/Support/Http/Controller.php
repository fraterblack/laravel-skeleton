<?php

namespace Lpf\Support\Http;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var User
     */
    protected $loggedUser;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->loggedUser = Auth::user();

            return $next($request);
        });
    }

    public function view($view, $data = [])
    {
        $loggedUser = Auth::user();

        return view($view, $data)->with(['logged_user' => $loggedUser]);
    }
}
