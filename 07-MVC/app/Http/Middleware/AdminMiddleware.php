<?php

namespace App\Http\Middleware;

use Contracts\Middleware\Contract;

class AdminMiddleware implements Contract
{
    /**
     * Handle an incoming request.
     *
     * @param mixed $request
     * @param mixed $next
     * @param mixed ...$role
     * @return mixed
     */
    public function handle($request, $next, ...$role)
    {
        if ($role[0] == 'admin') {
            header('Location: ' . url('about'));
            exit;
        }
        return $next($request);
    }
}