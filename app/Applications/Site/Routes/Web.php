<?php

namespace Lpf\Applications\Site\Routes;

use Lpf\Support\Http\Routing\RouteFile;

/**
 * Web Routes.
 *
 * This file is where you may define all of the routes that are handled
 * by your application. Just tell Laravel the URIs it should respond
 * to using a Closure or controller method. Build something great!
 */
class Web extends RouteFile
{
    /**
     * Declare Web Routes.
     */
    public function routes()
    {
        $this->router->pattern('id', '[0-9]+');

        $this->generalRoutes();
    }

    protected function generalRoutes()
    {
        $this->router->get('', [
            'uses' => 'General\DemoController@initial',
            'as' => 'initial',
        ]);
    }
}