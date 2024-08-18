<?php
//echo $_SERVER['REQUEST_URI'];
//var_dump($routes);
//echo "<br>";
//var_dump(segment());

// $route = array_column($GET_ROUTES, 'segment');
// var_dump($route);

$GET_ROUTES = isset($routes['GET']) ? $routes['GET'] : [];
$POST_ROUTES = isset($routes['POST']) ? $routes['POST'] : [];

// التحقق من وجود المسار في مسارات GET
if (!isset($_POST['_method']) && !is_null(segment()) && !in_array(segment(), array_column($GET_ROUTES, 'segment'))) {
    // $storage_segment = str_replace('/'.public_().'/','',segment());
    // if(preg_match('/^storage/i',$storage_segment)){
    //     storage($storage_segment);
    // }else{
    //     view('404');
    //         exit();
    // }
    //readfile(str_replace('/'.public_().'/','',segment()));
    
    view('404');
        exit();
}
