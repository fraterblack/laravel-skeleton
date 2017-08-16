<?php

namespace Lpf\Interfaces\Shared\Traits;

use Illuminate\Http\Request;
use Lpf\Support\Domain\Repository\Contracts\Repository;

trait SortableTrait
{
    /**
     * @param Repository $repository
     * @param Request $request
     * @return array
     */
    protected function reorder(Repository $repository, Request $request)
    {
        if ($repository->reorder($request->get('type'), $request->get('id'), $request->get('positionEntityId'))) {
            return ['success' => true];
        }

        return ['errors' => 'unknown error'];
    }

    /**
     * @param Request $request
     */
    public function resolveSortableLimit(Request $request)
    {
        if ($request->get('orderBy') == 'position') {
            config(['repository.pagination.limit' => 9999]);
        }
    }
}