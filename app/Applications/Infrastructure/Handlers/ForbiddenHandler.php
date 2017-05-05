<?php

namespace Lpf\Applications\Infrastructure\Handlers;

use Artesaos\Defender\Contracts\ForbiddenHandler as ForbiddenHandlerContract;
use Illuminate\Http\Request;

class ForbiddenHandler implements ForbiddenHandlerContract
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        $user = $this->request->user();

        app()->abort(403);
    }
}