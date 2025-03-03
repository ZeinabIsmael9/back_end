<?php

namespace Illuminates\Middleware;

use App\Core;

class Middleware
{

    /**
     * @param mixed $middlewareStack
     * @param mixed $next
     * 
     * @return mixed
     */
    public static function handleMiddleware($middlewareStack, $next)
    {
        if (!empty($middlewareStack) && is_array($middlewareStack)) {
            foreach (array_reverse($middlewareStack) as $middleware) {
                $next = function ($request) use ($middleware, $next) {
                    $role=explode(',', $middleware);
                    $middleware = array_shift($role);
                    if(!class_exists($middleware)){
                        $middleware = self::getFromCore($middleware);
                    }
                    // var_dump(class_exists($middleware));
                    // exit;
                    return (new $middleware)->handle($request, $next, ...$role);
                };
            }
        }
        return $next;
    }

    public static function getFromCore($key, $type='web')
    {
        if ($type == 'web' && isset(Core::$middlewareWebRoute[$key])) {
            return Core::$middlewareWebRoute[$key];
        } elseif ($type == 'api' && isset(Core::$middlewareApiRoute[$key])) {
            return Core::$middlewareApiRoute[$key];
        } else {
            throw new \Exception('middleware not found');
        }
    }
}
