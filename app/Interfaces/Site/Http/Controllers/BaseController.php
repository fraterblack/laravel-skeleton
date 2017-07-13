<?php

namespace Lpf\Interfaces\Site\Http\Controllers;

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
            $this->seo()->setTitle($attributes['title']);
        }

        if (isset($attributes['description'])) {
            $this->seo()->setDescription($attributes['description']);
        }

        if (isset($attributes['keywords'])) {
            $this->seo()->metatags()->setKeywords($attributes['keywords']);
        }
    }
}
