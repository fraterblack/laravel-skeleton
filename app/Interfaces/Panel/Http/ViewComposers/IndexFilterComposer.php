<?php

namespace Lpf\Interfaces\Panel\Http\ViewComposers;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IndexFilterComposer
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function compose(View $view)
    {
        $filters = $this->injectActiveFilters($view->filters);

        //Filtros
        $view->with([
            'filters' => $filters,
            'active_search' => $this->request->get('search'),
            'active_order_by' => $this->request->get('orderBy'),
            'active_sorted_by' => $this->request->get('sortedBy', 'desc'),
        ]);
    }

    protected function injectActiveFilters($filters)
    {
        $filterParams = ! empty($this->request->get('filter')) ? $this->request->get('filter') : [];

        return collect($filters)->map(function ($filter) use ($filterParams) {
            //Parse active filters from Request
            $activeFilters = array_filter($filterParams, function ($item) use ($filter) {
                if (stripos($item, $filter['column']) !== false) {
                    return true;
                }

                return false;
            });

            if (!empty($activeFilters)) {
                //sort($activeFilters);
                $filter['active_filter'] = collect($activeFilters)->map(function ($activeFilter) use ($filter) {
                    $activeFilterParams = explode('.', $activeFilter);

                    return collect([
                        'sentence' => $activeFilter,
                        'column' => $activeFilterParams[0],
                        'condition' => $activeFilterParams[1],
                        'value' => $this->castValue($filter['type'], $activeFilterParams[2]),
                    ]);
                });
            }

            return collect($filter);
        });
    }

    protected function castValue($filterType, $value)
    {
        switch ($filterType) {
            case 'date':
            case 'date-range':
                return Carbon::createFromFormat('Y-m-d', $value);
                break;
            case 'text':
                return str_replace('%', '', $value);
            case 'number':
                return (int) $value;
            default:
                return $value;
                break;
        }
    }
}