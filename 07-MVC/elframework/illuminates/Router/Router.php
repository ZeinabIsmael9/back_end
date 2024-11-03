<?php

namespace Illuminates\Router;

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
     *
     * @param string $method
     * @param string $route
     * @param string|object $controller
     * @param string|callable $action
     * @param array $middlewares
     *
     * @return void
     */
    public static function add(string $method, string $route, $controller, $action, array $middlewares = []): void
    {
        $route = ltrim($route, '/');
        
        self::$routes[$method][$route] = compact('controller', 'action', 'middlewares');
    }

    /**
     * @return array
     */
    public function routes(): array
    {
        return static::$routes;
    }

    /**
     *
     * @param string $uri
     * @param string $method
     * @throws \Exception
     * @return void
     */
    public static function dispatch($uri, $method): void
    {
        $uri = parse_url($uri, PHP_URL_PATH);

        $basePath = '/back_end/07-MVC/public/';
        
        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        if (isset(self::$routes[$method][$uri])) {
            $data = self::$routes[$method][$uri];
            
            if (is_callable($data['action'])) {
                $data['action']();
            } else {
                call_user_func_array([new $data['controller'], $data['action']], []);
            }
        } else {
            throw new \Exception('This route "' . $uri . '" was not found');
        }
    }
}
