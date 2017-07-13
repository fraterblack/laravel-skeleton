<?php

namespace Lpf\Interfaces\Shared\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Illuminate\Session\TokenMismatchException;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [];

    public function handle($request, Closure $next)
    {
        $this->except = config('app.no_csrf');

        try {
            return parent::handle($request, $next);
        } catch (TokenMismatchException $e) {
            return redirect()->back()->with('error', 'Requisição inválida, tente novamente.');
        }
    }
}
