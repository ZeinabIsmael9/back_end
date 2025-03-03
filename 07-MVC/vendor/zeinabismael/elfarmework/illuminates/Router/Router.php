<?php

namespace Illuminates\Router;

use Illuminates\Middleware\Middleware;

class Router
{
    /**
     * @var array $routes
     */
    protected static $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'PATCH' => [],
        'DELETE' => [],
    ];

    /**
     * @var string $public
     */
    private static $public;

    public static function public_path(): string
    {
        if (!isset(static::$public)) {
            static::$public = getcwd() . 'public';
        }
        return static::$public;
    }

    /**
     * Adds a route to the routing table.
     *
     * @param string $method
     * @param string $route
     * @param string|object $controller
     * @param string|callable $action
     * @param array $middlewares
     * @return void
     */
    public static function add(string $method, string $route, $controller, $action = null, array $middlewares = []): void
    {
        $route = trim($route, '/');
        $route = preg_replace('/\{[^\}]+\}/', '([^/]+)', $route); // Convert {param} to a regex pattern
        self::$routes[$method][$route] = compact('controller', 'action', 'middlewares');
    }

    /**
     * Returns all defined routes.
     *
     * @return array
     */
    public function routes(): array
    {
        return static::$routes;
    }
    /**
     * Dispatches a request to the appropriate controller and action.
     *
     * @param string $uri
     * @param string $method
     * @throws \Exception
     * @return void
     */
    public static function dispatch($uri, $method)
    {
        $basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        $cleanedUri = trim(str_replace([$basePath, static::public_path()], '', $uri), '/');
        
        foreach (self::$routes[$method] as $routePattern => $data) {
            $pattern = '#^' . $routePattern . '$#';
            if (preg_match($pattern, $cleanedUri, $matches)) {
                array_shift($matches);
                $controller = $data['controller'];
                if (is_object($controller)) {
                    $middlewareStack = $data['action'];
                    $next = function ($request) use ($controller, $matches) {
                        return $controller(...$matches);
                    };

                    $next = Middleware::handleMiddleware($middlewareStack, $next);
                    if (is_callable($next)) {
                        echo $next($cleanedUri);
                    } else {
                        throw new \Exception('Middleware stack returned a non-callable response.');
                    }
                } else {
                    $action = $data['action'];
                    $middlewareStack = $data['middlewares'] ?? [];
                    $next = function ($request) use ($controller, $action, $matches) {
                        return call_user_func_array([new $controller, $action], $matches);
                    };

                    $next = Middleware::handleMiddleware($middlewareStack, $next);
                    if (is_callable($next)) {
                        echo $next($cleanedUri);
                    } else {
                        throw new \Exception('Middleware stack returned a non-callable response.');
                    }
                }
                return;
            }
        }

        throw new \Exception('This route "' . $cleanedUri . '" was not found');
    }


    // public static function dispatch($uri, $method)
    // {
    // $uri = ltrim($uri,'/'.static::public_path());
    // foreach (static::$routes[$method] as $key => $val) {
    //     $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '(?P<$1>[a-zA-Z0-9_]+)', $key);
    //     $pattern = "#^" . $pattern . "$#";
    //     if (preg_match($pattern, $uri, $matches)) {
    //         $controller = $val['controller'];
    //         $action = $val['action'];
    //         $middleware = isset($val['middleware']) ? $val['middleware'] : null;
    //         $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
    //          var_dump($params); // Debug matched parameters
    //     return call_user_func(array(new $controller, $action), $params);
    //     }
    // }
}
