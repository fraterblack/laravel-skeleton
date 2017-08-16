<?php

namespace Lpf\Interfaces\Panel\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class MainMenuComposer
{
    protected $request;

    protected $menuParameters;

    protected $activeMenuItem;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->menuParameters = config('admin-panel.menu', []);
    }

    public function compose(View $view)
    {
        $this->activeMenuItem = $view->active_menu_item;

        $view->with([
            'menu' => $this->menuParameters()
        ]);
    }

    /**
     * @return Collection
     */
    protected function menuParameters()
    {
        $menuParameters = $this->prepareMenuParameters($this->menuParameters);

        $menuParameters = $this->hideBlockedItems($menuParameters);
        $menuParameters = $this->parseMenuItems($menuParameters);

        return $menuParameters;
    }

    /**
     * @param array $data
     * @param integer $depth
     * @return Collection
     */
    protected function prepareMenuParameters(array $data, $depth = 0)
    {
        return collect($data)->map(function ($item) use ($depth) {
            if (! empty($item['submenu'])) {
                $item['submenu'] = $this->prepareMenuParameters($item['submenu'], ($depth + 1));
            }

            $item['depth'] = $depth;

            return collect($item);
        });
    }

    /**
     * @param Collection $data
     * @return Collection
     */
    protected function hideBlockedItems(Collection $data)
    {
        return $data->filter(function ($item, $x) {
            if ($item->get('submenu')) {
                $item->put('submenu', $this->hideBlockedItems($item->get('submenu')));

                if ($item->get('submenu')->isEmpty()) {
                    return false;
                }
            }

            //Verifica se usuário pode acessar o link
            if ($item->get('shield') && ! $this->request->user()->canDo($item->get('shield'))) {
                return false;
            }

            return true;
        });
    }

    /**
     * @param Collection $data
     * @return Collection
     */
    protected function parseMenuItems(Collection $data)
    {
        return $data->map(function ($item, $key) {
            $isActive = false;

            if ($item->get('submenu')) {
                $item->put('submenu', $this->parseMenuItems($item->get('submenu')));

                $isActive = $item->get('submenu')->containsStrict('active', true);
            }

            $item->put('route', $this->createRoute($item->get('route')));
            $item->put('active', ! $isActive ? $this->itemIsActive($key) : $isActive);

            return collect($item);
        });
    }

    /**
     * @param array|null $routeParameters
     * @return string
     */
    protected function createRoute(array $routeParameters = null)
    {
        $parameters = collect($routeParameters, []);

        if ($parameters->get(0)) {
            return route($routeParameters[0], $parameters->get(1, []));
        }

        return '';
    }

    /**
     * @param string|null $code
     * @return boolean
     */
    protected function itemIsActive($code = null)
    {
        if ($code == $this->activeMenuItem) {
            return true;
        }

        return false;
    }
}