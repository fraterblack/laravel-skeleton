<?php

namespace Lpf\Applications\Panel\Routes;

use Lpf\Support\Http\Routing\RouteFile;

/**
 * Auth Web Routes.
 *
 * This file is where you may define all of the routes that are handled
 * by your application. Just tell Laravel the URIs it should respond
 * to using a Closure or controller method. Build something great!
 */
class AuthWeb extends RouteFile
{
    /**
     * Declare Web Routes.
     */
    public function routes()
    {
        $this->router->pattern('id', '[0-9]+');

        $this->authRoutes();
    }

    protected function authRoutes()
    {
        //as: admin.auth, prefix: / , namespace: \Artees\Applications\Panel\Http\Controllers\Auth
        $this->router->group(['as' => 'auth.', 'namespace' => 'Auth'], function () {
            $this->router->get('login', [
                'uses' => 'LoginController@showLoginForm',
                'as' => 'getLogin',
            ]);
            $this->router->post('login', [
                'uses' => 'LoginController@login',
                'as' => 'postLogin',
            ]);
            $this->router->get('logout', [
                'uses' => 'LoginController@logout',
                'as' => 'logout',
            ]);

            $this->router->get('esqueci-senha', [
                'uses' => 'ForgotPasswordController@showLinkRequestForm',
                'as' => 'getForgotPassword',
            ]);
            $this->router->post('esqueci-senha', [
                'uses' => 'ForgotPasswordController@sendResetLinkEmail',
                'as' => 'postForgotPassword',
            ]);

            $this->router->get('resetar-senha/{token}', [
                'uses' => 'ResetPasswordController@showResetForm',
                'as' => 'getResetPassword',
            ]);
            $this->router->post('resetar-senha', [
                'uses' => 'ResetPasswordController@reset',
                'as' => 'postResetPassword',
            ]);

            //Laravel Socialite
            /*$this->router->get('auth/{driver}', [
                'uses' => 'LoginController@redirectToProvider',
                'as' => 'socialOAuth',
            ]);
            $this->router->get('auth/{driver}/callback', [
                'uses' => 'LoginController@handleProviderCallback',
                'as' => 'socialOAuth.callback',
            ]);*/
        });
    }
}