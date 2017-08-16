<?php

namespace Lpf\Interfaces\Panel\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class MainMenuComposer
{
    protected $request;

    protected $menuParameters;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->menuParameters = config('admin-panel.menu', []);
    }

    public function compose(View $view)
    {
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
     * @return Collection
     */
    protected function prepareMenuParameters(array $data)
    {
        return collect($data)->map(function ($item) {
            if (! empty($item['submenu'])) {
                $item['submenu'] = $this->prepareMenuParameters($item['submenu']);
            }

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

                if ($item->get('submenu')->count() == 0) {
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
        return $data->map(function ($item) {
            if ($item->get('submenu')) {
                $item->put('submenu', $this->parseMenuItems($item->get('submenu')));
            }

            $item->put('route', $this->createRoute($item->get('route')));

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
}