<?php
// echo "<hr>";
//echo $_SERVER['REQUEST_URI'];
// echo "<br>";
route_get('/', 'home');
route_get('/users', 'users');
route_get('/{lang}', 'views.controllers.set_language');
route_post('/users','create_user');


var_dump(segment());
//var_dump($routes);
route_init();
