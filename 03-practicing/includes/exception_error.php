<?php
//echo $_SERVER['REQUEST_URI'];
//var_dump($routes);
//echo "<br>";
//var_dump(segment());

// $route = array_column($GET_ROUTES, 'segment');
// var_dump($route);

$GET_ROUTES = isset($routes['GET']) ? $routes['GET'] : [];
$POST_ROUTES = isset($routes['POST']) ? $routes['POST'] : [];

// Check if the request is a GET request and the segment is not null
if (!isset($_POST['_method']) && !is_null(segment())) {
    // Check if the current segment exists in the GET routes
    $route_segments = array_column($GET_ROUTES, 'segment');
    
    if (!in_array(segment(), $route_segments)) {
        // Handle the case where the segment is not found in the GET routes
        // Uncomment and customize this block if needed
        // $storage_segment = str_replace('/'.public_().'/','',segment());
        // if(preg_match('/^storage/i', $storage_segment)){
        //     storage($storage_segment);
        // } else {
        //     view('404');
        //     exit();
        // }

    //readfile(str_replace('/'.public_().'/','',segment()));
    http_response_code(404);
    view('404');
        exit();
}
}