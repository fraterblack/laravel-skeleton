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

        $this->userHasPermission();

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

    final protected function userHasPermission()
    {
        $this->requiredPermissionsAttributeIsValid();

        //Defender ACL
        if ($this->requiredPermissions !== null) {
            foreach ($this->requiredPermissions as $permission) {
                $this->middleware('needsPermission:' . config('defender.superuser_role') . '|' . $permission . ',true');
            }
        } else {
            $this->middleware('needsPermission:' . config('defender.superuser_role') . '|admin,true');
        }
    }

    final protected function requiredPermissionsAttributeIsValid()
    {
        if (! property_exists($this, 'requiredPermissions')) {
            throw new \InvalidArgumentException('O atributo requiredPermissions não está presente no controller');
        }

        if ($this->requiredPermissions !== null && ! is_array($this->requiredPermissions)) {
            throw new \InvalidArgumentException('O atributo requiredPermissions deve ser um array ou ser nulo');
        }

        return true;
    }
}
