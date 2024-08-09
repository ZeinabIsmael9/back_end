<?php
// echo "<hr>";
//echo $_SERVER['REQUEST_URI'];
// echo "<br>";
route_get('/back_end/03-practicing/', 'home');
route_get('/back_end/03-practicing/{lang}', 'views.controllers.set_language');
// route_get('/back_end/03-practicing/articls');
// route_get('/back_end/03-practicing/posts');
// route_get('/back_end/03-practicing/data');
route_post('/back_end/03-practicing/users','create_user');
// route_post('/back_end/03-practicing/tests');

//var_dump($routes);
route_init();
