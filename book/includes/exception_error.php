<?php

$GET_ROUTES = isset($routes['GET']) ? $routes['GET'] : [];
$POST_ROUTES = isset($routes['POST']) ? $routes['POST'] : [];

if (!isset($_POST['_method']) && !is_null(segment())) {
    $route_segments = array_column($GET_ROUTES, 'segment');
    if (!in_array(segment(), $route_segments)) {
        http_response_code(404);
        view('404');
        exit();
    }
}
?>
