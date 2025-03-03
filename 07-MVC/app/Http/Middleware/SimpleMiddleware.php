<?php

namespace App\Http\Middleware;

use Contracts\Middleware\Contract;

class SimpleMiddleware implements Contract
{
    /**
     * Handle an incoming request.
     *
     * @param mixed $request
     * @param mixed $next
     * @return mixed
     */
    public function handle($request, $next , ...$role)
    {
        // echo "<pre>";
        // var_dump($role);
        // echo "</pre>";
        if (2 == 2) {
            header('Location: ' . url('about'));
            exit;
        }
        return $next($request);
    }
}
