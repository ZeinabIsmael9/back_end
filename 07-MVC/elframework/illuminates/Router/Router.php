<?php

namespace Illuminates\Router;

use Illuminates\Logs\Log;
use Illuminates\Middleware\Middleware;

class Router
{
    /**
     * @var array $routes
     */
    protected static $routes = [];
    protected static $groupAttributes = [];


    /**
     * Adds a route to the routing table.
     *
     * @param string $method
     * @param string $route
     * @param string|object $controller
     * @param string|callable $action
     * @param array $middleware
     * @return void
     */
    public static function add(string $method, string $route, $controller, $action = null, array $middleware = [])
    {
        $route  = self::applyGroupPrefix($route);
        $middleware = array_merge(static::getGroupMiddleware(), $middleware);
        self::$routes[] = [
            'method' => $method,
            'uri' => $route == '/' ? $route : ltrim($route, '/'),
            'controller' => $controller,
            'action' => $action,
            'middleware' => $middleware
        ];
    }

    /**
     * @param [mixed] $attributes
     * @param [mixed] $callback
     * @return void
     */
    public static function group($attributes, $callback): void
    {
        $previousGroupAttribute  = static::$groupAttributes;
        static::$groupAttributes = array_merge(static::$groupAttributes, $attributes);
        call_user_func($callback, new self);
        static::$groupAttributes = $previousGroupAttribute;
    }

    protected static function applyGroupPrefix($route): string
    {
        if (isset(static::$groupAttributes['prefix'])) {
            $full_route = rtrim(static::$groupAttributes['prefix'], '/') . '/' . ltrim($route, '/');
            return rtrim(ltrim($full_route, '/'), '/');
        } else {
            return $route;
        }
    }

    protected static function getGroupMiddleware(): array
    {
        return static::$groupAttributes['middleware'] ?? [];
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
    public static function dispatch($uri = '/', $method)
    {
        $basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        $cleanedUri = trim(str_replace([$basePath, '/' . ROOT_DIR . '/'], '', $uri), '/');
        $cleanedUri = empty($cleanedUri) ? '/' : $cleanedUri;
        $method = strtoupper($method);

        foreach (static::$routes as $route) {
            if ($route['method'] == $method) {
                $routePattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_]+)', $route['uri']);
                $pattern = '#^' . $routePattern . '$#';
                if (preg_match($pattern, $cleanedUri, $matches)) {
                    array_shift($matches);
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                    $controller = $route['controller'];
                    if (is_object($controller)) {
                        $middlewareStack = $route['action'];
                        $next = function ($request) use ($controller, $params) {
                            return $controller(...$params);
                        };

                        $next = Middleware::handleMiddleware($middlewareStack, $next);
                        if (is_callable($next)) {
                            echo $next($cleanedUri);
                        } else {
                            throw new \Exception('Middleware stack returned a non-callable response.');
                        }
                    } else {
                        $action = $route['action'];
                        $middlewareStack = $route['middleware'];
                        $next = function ($request) use ($controller, $action, $params) {
                            return call_user_func_array([new $controller, $action], $params);
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
        }
        throw new Log('This route "' . $cleanedUri . '" was not found');
    }
}
