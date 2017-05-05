<?php

namespace Lpf\Applications\Panel\Http\Controllers;

use Artesaos\SEOTools\Traits\SEOTools;
use Lpf\Support\Http\Controller;

class BaseController extends Controller
{
    use SEOTools;

    function __construct()
    {
        parent::__construct();
    }

    protected $itemsPerPage = 16;

    protected function getItemsPerPage()
    {
        return $this->itemsPerPage;
    }

    protected function setSeo($attributes = array())
    {
        if (isset($attributes['title'])) {
            $this->seo()->setTitle($attributes['title'] . ' - Painel de Administração');
        }

        if (isset($attributes['description'])) {
            $this->seo()->setDescription($attributes['description']);
        }

        if (isset($attributes['keywords'])) {
            $this->seo()->metatags()->setKeywords($attributes['keywords']);
        }
    }

    protected function redirectAfterAction($action, $route, $actionResult = 'success', $customMessage = null)
    {
        switch ($action) {
            case 'store':
                $message = 'Cadastrado com sucesso!';
                break;
            case 'update':
                $message = 'Editado com sucesso!';
                break;
            default:
                $message = 'Ação efetuada com sucesso!';
                break;
        }

        return redirect()->to($route)->with($actionResult, !empty($customMessage) ? $customMessage : $message);
    }
}
