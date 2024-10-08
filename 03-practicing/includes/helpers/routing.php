<?php

$routes = [];

if (!function_exists('route_get')) {
    /**
     * Define a GET route.
     *
     * @param string $segment The URL segment for the route.
     * @param string|null $view The view or handler associated with the route.
     * @return void
     */
    function route_get($segment, $view = null)
    {
        global $routes;
        $routes['GET'][] = [
            'segment' => '/' . public_() . '/' . ltrim($segment, '/'),
            'view' => $view,
        ];
        //echo "aaaaa";
    }
}

if (!function_exists('route_post')) {
    /**
     * Define a POST route.
     *
     * @param string $segment The URL segment for the route.
     * @param string|null $view The view or handler associated with the route.
     * @return void
     */
    function route_post($segment, $view = null)
    {
        global $routes;
        $routes['POST'][] = [
            'segment' => '/' . public_() . '/' . ltrim($segment, '/'),
            'view' => $view,
        ];
        //echo "aaaaa";

    }
}

/**
 * Initialize the routing system and handle the current request.
 *
 * This function checks the requested URL segment against the defined
 * routes and loads the corresponding view or returns a 404 error if the
 * route is not found.
 *
 * @return void
 */
function route_init()
{
    global $routes;
    $view = null;
    $GET_ROUTES = isset($routes['GET']) ? $routes['GET'] : [];
    $POST_ROUTES = isset($routes['POST']) ? $routes['POST'] : [];

    if (!isset($_POST['_method'])) {
        // Check GET routes
        foreach ($GET_ROUTES as $rget) {
            if (segment() == $rget['segment']) {
                $view = $rget['view'];
                view($view);
                break;
            }
        }
    }


    // Check POST routes if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach ($POST_ROUTES as $rpost) {
            if (segment() == $rpost['segment']) {
                $view = $rpost['view'];
                break;
            }
        }
        // If POST route is not found, show 404 error
        if (!is_null(segment()) && !in_array(segment(), array_column($POST_ROUTES, 'segment'))) {
            http_response_code(404);
            view('404');
            exit();
        }
        if ($view) {
            view($view);
        } else {
            http_response_code(404);
            echo "<h1>404 Page Not Found</h1>";
        }
    }
}

if (!function_exists('redirect')) {
    /**
     * Redirect to a specified URL path.
     *
     * @param string $path The path to redirect to.
     * @return void
     */
    function redirect($path)
    {
        $check_path = parse_url($path);
        //var_dump(parse_url($path));
        if (isset($check_path['scheme']) && isset($check_path['host'])) {
            header('location:' . $path);
        } else {
            header('location:' . url($path));
        }
        exit();
    }
}


if (!function_exists('redirect_if')) {
    /**
     * Redirect if to a specified URL path.
     *
     * @param string $path The path to redirect to.
     * @return void
     */
    function redirect_if(bool $statement,string $url)
    {
        if($statement){
            redirect($url);
        }
    }
}

if (!function_exists('back')) {
    /**
     * back to a previous page.
     *
     * @param string $path The path to redirect to.
     * @return void
     */
    function back()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}

if (!function_exists('url')) {
    /**
     * Generate a full URL for a given segment.
     *
     * @param string $segment The URL segment to append.
     * @return string The full URL.
     */
    function url($segment)
    {
        $url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $url .= $_SERVER['HTTP_HOST'];
        return $url  . '/' . public_() . '/' . ltrim($segment, '/');
    }
}



if (!function_exists('aurl')) {
    /**
     * Generate a full Admin URL for a given segment.
     *
     * @param string $segment The URL segment to append.
     * @return string The full URL.
     */
    function aurl($segment)
    {
        $url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $url .= $_SERVER['HTTP_HOST'];
        return $url  . '/' . public_() . '/' . ADMIN . '/' . ltrim($segment, '/');
    }
}

if (!function_exists('segment')) {
    /**
     * Get the current URL segment from the request URI.
     *
     * @return string The current URL segment.
     */
    function segment()
    {
        $segment = ltrim($_SERVER['REQUEST_URI'], '/');
        $removeQueryParam = explode('?', $segment);
        return '/' . $removeQueryParam[0];
    }
}
