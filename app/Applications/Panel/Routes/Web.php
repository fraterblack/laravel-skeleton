<?php

namespace Lpf\Applications\Panel\Routes;

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
        $this->utilsRoutes();

        //Users
        $this->usersRoutes();
        $this->userRolesRoutes();
        $this->userPermissionsRoutes();

        //CMS
        //$this->pagesRoutes();
        //$this->bannerPlacesRoutes();
        //$this->bannersRoutes();
        //$this->contactRecipientsRoutes();
        //$this->contactsRoutes();
    }

    protected function generalRoutes()
    {
        //as: admin, prefix: admin
        $this->router->get('', [
            'uses' => 'General\DashboardController@initial',
            'as' => 'initial',
        ]);
    }

    protected function usersRoutes()
    {
        //as: admin.users, prefix: admin/usuarios, namespace: \Lpf\Applications\Panel\Http\Controllers\Users
        $this->router->group(['as' => 'users.', 'prefix' => 'usuarios', 'namespace' => 'Users'], function () {
            $this->router->get('', [
                'uses' => 'UsersController@index',
                'as' => 'index',
            ]);

            $this->router->post('', [
                'uses' => 'UsersController@index',
                'as' => 'index',
            ]);

            $this->router->get('cadastrar', [
                'uses' => 'UsersController@create',
                'as' => 'create',
            ]);

            $this->router->post('cadastrar', [
                'uses' => 'UsersController@store',
                'as' => 'store',
            ]);

            $this->router->get('{id}/editar', [
                'uses' => 'UsersController@edit',
                'as' => 'edit',
            ]);

            $this->router->put('{id}/editar', [
                'uses' => 'UsersController@update',
                'as' => 'update',
            ]);

            $this->router->get('{id}/excluir', [
                'uses' => 'UsersController@delete',
                'as' => 'delete',
            ]);

            $this->router->get('busca/{output}/{query?}', [
                'uses' => 'UsersController@search',
                'as' => 'search',
            ]);

            $this->router->get('{id}', [
                'uses' => 'UsersController@find',
                'as' => 'find',
            ]);
        });
    }

    protected function userRolesRoutes()
    {
        //as: admin.user_roles, prefix: admin/usuarios/funcoes-de-usuario, namespace: \Lpf\Applications\Panel\Http\Controllers\Users
        $this->router->group(['as' => 'user_roles.', 'prefix' => 'usuarios/funcoes-de-usuario', 'namespace' => 'Users'], function () {
            $this->router->get('', [
                'uses' => 'RolesController@index',
                'as' => 'index',
            ]);

            $this->router->post('', [
                'uses' => 'RolesController@index',
                'as' => 'index',
            ]);

            $this->router->get('cadastrar', [
                'uses' => 'RolesController@create',
                'as' => 'create',
            ]);

            $this->router->post('cadastrar', [
                'uses' => 'RolesController@store',
                'as' => 'store',
            ]);

            $this->router->get('{id}/editar', [
                'uses' => 'RolesController@edit',
                'as' => 'edit',
            ]);

            $this->router->put('{id}/editar', [
                'uses' => 'RolesController@update',
                'as' => 'update',
            ]);

            $this->router->get('{id}/excluir', [
                'uses' => 'RolesController@delete',
                'as' => 'delete',
            ]);

            $this->router->get('{id}/gerenciar-recursos', [
                'uses' => 'RolesController@editPermissions',
                'as' => 'editPermissions',
            ]);

            $this->router->put('{id}/gerenciar-recursos', [
                'uses' => 'RolesController@updatePermissions',
                'as' => 'updatePermissions',
            ]);
        });
    }

    protected function userPermissionsRoutes()
    {
        //as: admin.user_role_permissions, prefix: admin/usuarios/recursos-de-funcao, namespace: \Lpf\Applications\Panel\Http\Controllers\Users
        $this->router->group(['as' => 'user_role_permissions.', 'prefix' => 'usuarios/recursos-de-funcao', 'namespace' => 'Users'], function () {
            $this->router->get('', [
                'uses' => 'PermissionsController@index',
                'as' => 'index',
            ]);

            $this->router->post('', [
                'uses' => 'PermissionsController@index',
                'as' => 'index',
            ]);

            $this->router->get('cadastrar', [
                'uses' => 'PermissionsController@create',
                'as' => 'create',
            ]);

            $this->router->post('cadastrar', [
                'uses' => 'PermissionsController@store',
                'as' => 'store',
            ]);

            $this->router->get('{id}/excluir', [
                'uses' => 'PermissionsController@delete',
                'as' => 'delete',
            ]);
        });
    }

    protected function utilsRoutes()
    {
        //as: admin.utils, prefix: admin/configuracoes, namespace: \Lpf\Applications\Panel\Http\Controllers\General
        $this->router->group(['as' => 'utils.', 'prefix' => 'configuracoes', 'namespace' => 'General'], function () {
            $this->router->get('controle-de-cache', [
                'uses' => 'UtilsController@cacheControl',
                'as' => 'cacheControl',
            ]);

            $this->router->get('resultado-controle-de-cache', [
                'uses' => 'UtilsController@cacheResult',
                'as' => 'cacheResult',
            ]);
        });
    }

    protected function pagesRoutes()
    {
        //as: admin.pages, prefix: admin/paginas, namespace: \Lpf\Applications\Panel\Http\Controllers\CMS
        $this->router->group(['as' => 'pages.', 'prefix' => 'paginas', 'namespace' => 'CMS'], function () {
            $this->router->match(['get', 'post'], '', [
                'uses' => 'PagesController@index',
                'as' => 'index',
            ]);

            $this->router->get('cadastrar', [
                'uses' => 'PagesController@create',
                'as' => 'create',
            ]);

            $this->router->post('cadastrar', [
                'uses' => 'PagesController@store',
                'as' => 'store',
            ]);

            $this->router->get('{id}/editar', [
                'uses' => 'PagesController@edit',
                'as' => 'edit',
            ]);

            $this->router->put('{id}/editar', [
                'uses' => 'PagesController@update',
                'as' => 'update',
            ]);

            $this->router->get('{id}/excluir', [
                'uses' => 'PagesController@delete',
                'as' => 'delete',
            ]);

            $this->router->get('{id}/ativar', [
                'uses' => 'PagesController@activate',
                'as' => 'activate',
            ]);

            $this->router->get('{id}/desativar', [
                'uses' => 'PagesController@deactivate',
                'as' => 'deactivate',
            ]);
        });
    }

    protected function bannerPlacesRoutes()
    {
        //as: admin.bannerPlaces, prefix: admin/pontos-de-banners, namespace: \Lpf\Applications\Panel\Http\Controllers\CMS
        $this->router->group(['as' => 'bannerPlaces.', 'prefix' => 'pontos-de-banners', 'namespace' => 'CMS'], function () {
            $this->router->match(['get', 'post'], '', [
                'uses' => 'BannerPlacesController@index',
                'as' => 'index',
            ]);

            $this->router->get('cadastrar', [
                'uses' => 'BannerPlacesController@create',
                'as' => 'create',
            ]);

            $this->router->post('cadastrar', [
                'uses' => 'BannerPlacesController@store',
                'as' => 'store',
            ]);

            $this->router->get('{id}/editar', [
                'uses' => 'BannerPlacesController@edit',
                'as' => 'edit',
            ]);

            $this->router->put('{id}/editar', [
                'uses' => 'BannerPlacesController@update',
                'as' => 'update',
            ]);

            $this->router->get('{id}/excluir', [
                'uses' => 'BannerPlacesController@delete',
                'as' => 'delete',
            ]);

            $this->router->get('{id}/ativar', [
                'uses' => 'BannerPlacesController@activate',
                'as' => 'activate',
            ]);

            $this->router->get('{id}/desativar', [
                'uses' => 'BannerPlacesController@deactivate',
                'as' => 'deactivate',
            ]);
        });
    }

    protected function bannersRoutes()
    {
        //as: admin.banners, prefix: admin/banners, namespace: \Lpf\Applications\Panel\Http\Controllers\CMS
        $this->router->group(['as' => 'banners.', 'prefix' => 'banners', 'namespace' => 'CMS'], function () {
            $this->router->match(['get', 'post'], '', [
                'uses' => 'BannersController@index',
                'as' => 'index',
            ]);

            $this->router->get('cadastrar', [
                'uses' => 'BannersController@create',
                'as' => 'create',
            ]);

            $this->router->post('cadastrar', [
                'uses' => 'BannersController@store',
                'as' => 'store',
            ]);

            $this->router->get('{id}/editar', [
                'uses' => 'BannersController@edit',
                'as' => 'edit',
            ]);

            $this->router->put('{id}/editar', [
                'uses' => 'BannersController@update',
                'as' => 'update',
            ]);

            $this->router->get('{id}/excluir', [
                'uses' => 'BannersController@delete',
                'as' => 'delete',
            ]);

            $this->router->get('{id}/ativar', [
                'uses' => 'BannersController@activate',
                'as' => 'activate',
            ]);

            $this->router->get('{id}/desativar', [
                'uses' => 'BannersController@deactivate',
                'as' => 'deactivate',
            ]);
        });
    }

    protected function contactRecipientsRoutes()
    {
        //as: admin.contactRecipients, prefix: admin/destinatarios-de-contato, namespace: \Lpf\Applications\Panel\Http\Controllers\CMS
        $this->router->group(['as' => 'contactRecipients.', 'prefix' => 'destinatarios-de-contato', 'namespace' => 'CMS'], function () {
            $this->router->match(['get', 'post'], '', [
                'uses' => 'ContactRecipientsController@index',
                'as' => 'index',
            ]);

            $this->router->get('cadastrar', [
                'uses' => 'ContactRecipientsController@create',
                'as' => 'create',
            ]);

            $this->router->post('cadastrar', [
                'uses' => 'ContactRecipientsController@store',
                'as' => 'store',
            ]);

            $this->router->get('{id}/editar', [
                'uses' => 'ContactRecipientsController@edit',
                'as' => 'edit',
            ]);

            $this->router->put('{id}/editar', [
                'uses' => 'ContactRecipientsController@update',
                'as' => 'update',
            ]);

            $this->router->get('{id}/excluir', [
                'uses' => 'ContactRecipientsController@delete',
                'as' => 'delete',
            ]);

            $this->router->get('{id}/ativar', [
                'uses' => 'ContactRecipientsController@activate',
                'as' => 'activate',
            ]);

            $this->router->get('{id}/desativar', [
                'uses' => 'ContactRecipientsController@deactivate',
                'as' => 'deactivate',
            ]);
        });
    }

    protected function contactsRoutes()
    {
        //as: admin.contacts, prefix: admin/contatos, namespace: \Lpf\Applications\Panel\Http\Controllers\CMS
        $this->router->group(['as' => 'contacts.', 'prefix' => 'contatos', 'namespace' => 'CMS'], function () {
            $this->router->match(['get', 'post'], '', [
                'uses' => 'ContactsController@index',
                'as' => 'index',
            ]);

            $this->router->get('{id}/detalhes', [
                'uses' => 'ContactsController@show',
                'as' => 'show',
            ]);

            $this->router->get('{id}/excluir', [
                'uses' => 'ContactsController@delete',
                'as' => 'delete',
            ]);

            $this->router->get('{id}/marcar-como-respondido', [
                'uses' => 'ContactsController@markAsReplied',
                'as' => 'markAsReplied',
            ]);

            $this->router->get('{id}/desmarcar-como-respondido', [
                'uses' => 'ContactsController@unmarkAsReplied',
                'as' => 'unmarkAsReplied',
            ]);
        });
    }
}