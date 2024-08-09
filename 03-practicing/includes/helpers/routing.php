<?php

$routes = [];

if (!function_exists('route_get')) {
    function route_get($segment, $view = null) {
        global $routes;
        $routes['GET'][] = [
            'segment' => '/' . ltrim($segment, '/'),
            'view' => $view,
        ];
    }
}


if (!function_exists('route_post')) {
    function route_post($segment, $view = null) {
        global $routes;
        $routes['POST'][] = [
            'segment' => '/' . ltrim($segment, '/'),
            'view' => $view,
        ];
    }
}

function route_init() {
    global $routes;
    $view = null;
    $GET_ROUTES = isset($routes['GET']) ? $routes['GET'] : [];
    $POST_ROUTES = isset($routes['POST']) ? $routes['POST'] : [];

    // هنا 
    //echo "Requested Segment: " . segment();

    foreach($GET_ROUTES as $rget){
        if (segment() == $rget['segment']){
            $view = $rget['view'];
            break; // هنا بردو استوب
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach($POST_ROUTES as $rpost){
            if (segment() == $rpost['segment']){
                $view = $rpost['view'];
                break; // هنا تعملي استوب
            }
        }
        if (!is_null(segment()) && !in_array(segment(), array_column($POST_ROUTES, 'segment'))) {
            view('404');
            exit();
        }
    }

    if ($view) {
        view($view);
    } else {
        echo "<h1>404 Page Not Found</h1>";
    }
}
if (!function_exists('redirect')){
    function redirect($path) {
        header('Location: ' . url($path));
        exit();
    }
}

if (!function_exists('url')){
    function url($segment){
        $url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $url .= $_SERVER['HTTP_HOST'];
        return $url . '/' . ltrim($segment, '/');
    }
}


if (!function_exists('segment')) {
    function segment() {
        $segment = ltrim($_SERVER['REQUEST_URI'], '/');
        $removeQueryParam = explode('?', $segment);
        return '/' . $removeQueryParam[0];
    }
}


