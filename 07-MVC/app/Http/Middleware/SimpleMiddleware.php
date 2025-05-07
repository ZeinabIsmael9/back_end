<?php

    namespace App\Http\Middleware;
    
    use Contracts\Middleware\Contract;
    use Illuminates\FrameworkSetting;
    
    class SimpleMiddleware implements Contract
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
            // var_dump($request);
            FrameworkSetting::setlocale($_GET['lang'] ?? 'en');
            if (!empty($role) && $role[0] == 'user') {
                header('Location: ' . url('about'));
                exit;
            }
            return $next($request);
        }
    }