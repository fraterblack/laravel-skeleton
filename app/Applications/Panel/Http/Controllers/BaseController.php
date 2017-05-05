<?php

namespace Lpf\Applications\Panel\Http\Controllers;

use Artesaos\SEOTools\Traits\SEOTools;
use Lpf\Support\Http\Controller;

class BaseController extends Controller
{
    use SEOTools;

    protected $mainTitle = 'Painel de Administração';
    protected $pageName = 'Início';

    protected $itemsPerPage = 16;

    function __construct()
    {
        parent::__construct();

        $this->setPageTitle();
    }

    protected function setPageTitle()
    {
        $this->setSeo([
            'title' => !empty($this->pageName) ? $this->pageName . ' - ' . $this->mainTitle :  $this->mainTitle
        ]);
    }

    protected function setSeo($attributes = array())
    {
        if (isset($attributes['title'])) {
            $this->seo()->setTitle($attributes['title']);
        }
    }

    protected function setPageName($name = '')
    {
        $this->pageName = $name;
    }

    protected function getItemsPerPage()
    {
        return $this->itemsPerPage;
    }

    final protected function userHasPermission(array $permissions = null)
    {
        //Obligatory to all users that access panel
        $this->middleware('auth');

        //Defender ACL
        if ($permissions) {
            foreach ($permissions as $permission) {
                $this->middleware('needsPermission:' . config('defender.superuser_role') . '|' . $permission . ',true');
            }
        } else {
            $this->middleware('needsPermission:' . config('defender.superuser_role') . '|admin,true');
        }
    }
}
