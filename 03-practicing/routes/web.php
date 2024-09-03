<?php
include base_path('routes/admin.php');
// echo "<hr>";
// echo $_SERVER['REQUEST_URI'];
// echo "<br>";
route_get('/', 'front.home');
route_get('/users', 'users'); 
route_get('/{lang}', 'views.controllers.set_language'); 
route_post('/users', 'create_user'); 
route_post('/upload', 'controllers.upload'); 



route_get('/news/archive', 'front.archive'); 
route_get('/category', 'front.categories.category'); 
route_get('/news', 'front.categories.news'); 
route_post('add/comment','controllers.front.add_comments');



// var_dump(segment());
//var_dump($routes);
route_init();
